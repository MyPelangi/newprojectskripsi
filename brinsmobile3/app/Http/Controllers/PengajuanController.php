<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Prediksi;
use App\Models\Pengajuans;
use App\Models\TipeSepeda;
use App\Models\Pembayarans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PermohonanPenutupan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\PermohonanPenutupanMail;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipesepeda = TipeSepeda::all();
        // dd(auth()->user());
        return view('pages/pengajuanPolis', compact('tipesepeda'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function hitungPremi(Request $request)
     {
         $request->validate([
             'harga_sepeda' => 'required|numeric|min:1',
             'plan' => 'required|string|in:Silver,Gold,Platinum'
         ]);

         $tarif = [
             'Silver' => 0.0254,
             'Gold' => 0.0274,
             'Platinum' => 0.0285
         ];

         $hargaSepeda = $request->input('harga_sepeda');
         $plan = $request->input('plan');

         $premi = $hargaSepeda * $tarif[$plan];

         return response()->json([
             'harga_sepeda' => $hargaSepeda,
             'plan' => $plan,
             'premi' => round($premi, 2) // Membulatkan ke 2 desimal
         ]);
     }

     public function storePengajuan(Request $request)
     {
         $idUser = auth()->id();

         if (!$idUser) {
             return response()->json([
                 'success' => false,
                 'message' => 'Anda harus login untuk melakukan pengajuan'
             ], 401);
         }

         // Validasi input
         $validatedData = $request->validate([
             'harga_sepeda' => 'required|numeric',
             'kode_promo' => 'nullable|string|max:50',
             'plan' => 'required|string',
             'premi' => 'required|numeric',
             'total' => 'required|numeric',
             'merek_sepeda' => 'required|string',
             'warna_sepeda' => 'required|string|max:100',
             'tipe_sepeda' => 'required|exists:tipesepeda,id',
             'no_rangka_sepeda' => 'required|string|max:100',
             'model_sepeda' => 'required|string|max:100',
             'tahun_produksi' => 'required|integer',
             'seri_sepeda' => 'nullable|string|max:50',
             'no_invoice_pembelian' => 'required|string|max:100',
         ]);

         // **Cek apakah pengajuan dengan nomor rangka ini sudah ada**
         $pengajuan = Pengajuans::where('no_rangka_sepeda', $validatedData['no_rangka_sepeda'])
             ->where('id_user', $idUser) // Pastikan hanya data user saat ini
             ->first();

         if ($pengajuan) {
             // Jika ada, lakukan update data pengajuan
             $pengajuan->update($validatedData);
             return response()->json([
                 'success' => true,
                 'message' => 'Data pengajuan diperbarui',
                 'id_pengajuan' => $pengajuan->id
             ]);
         } else {
             // Jika tidak ada, buat pengajuan baru
             $pengajuan = Pengajuans::create([
                 'id_user' => $idUser,
                 'produk' => 'sepeda',
                 'harga_sepeda' => $validatedData['harga_sepeda'],
                 'kode_promo' => $validatedData['kode_promo'],
                 'plan' => $validatedData['plan'],
                 'premi' => $validatedData['premi'],
                 'total' => $validatedData['total'],
                 'merek_sepeda' => $validatedData['merek_sepeda'],
                 'warna_sepeda' => $validatedData['warna_sepeda'],
                 'tipe_sepeda' => $validatedData['tipe_sepeda'],
                 'no_rangka_sepeda' => $validatedData['no_rangka_sepeda'],
                 'model_sepeda' => $validatedData['model_sepeda'],
                 'tahun_produksi' => $validatedData['tahun_produksi'],
                 'seri_sepeda' => $validatedData['seri_sepeda'],
                 'no_invoice_pembelian' => $validatedData['no_invoice_pembelian'],
                 'dok_ktp' => null, // Default NULL
                 'dok_invoice_pembelian' => null, // Default NULL
                 'snk' => $validatedData['snk'] ?? false,
                 'status' => 'pending_ocr' // Status sementara menunggu validasi OCR
             ]);

             return response()->json([
                 'success' => true,
                 'message' => 'Pengajuan baru dibuat',
                 'id_pengajuan' => $pengajuan->id
             ]);
         }
     }


     public function storeOCR(Request $request)
     {
         $validatedData = $request->validate([
             'id_pengajuan' => 'required|integer',
             'path_ktp' => 'required|string',
             'path_invoice' => 'required|string',
         ]);

         // Cari pengajuan berdasarkan ID
         $pengajuan = Pengajuans::find($request->id_pengajuan);

         if (!$pengajuan) {
             return response()->json(["success" => false, "message" => "Pengajuan tidak ditemukan"], 404);
         }

         // Update kolom dokumen jika validasi OCR sukses
         $pengajuan->dok_ktp = $validatedData['path_ktp'];
         $pengajuan->dok_invoice_pembelian = $validatedData['path_invoice'];
         $pengajuan->status = 'valid'; // Tandai pengajuan sebagai valid
         $pengajuan->save();

         return response()->json([
             "success" => true,
             "message" => "Dokumen berhasil disimpan",
             "pengajuan" => $pengajuan
         ]);
     }

     public function storePrediksi(Request $request)
     {
         $request->validate([
             'id_pengajuan' => 'required|integer',
             'jenis_gambar' => 'required|string',
             'hasil_deteksi' => 'required|json',
             'status' => 'required|string',
             'path_gambar' => 'nullable|string',
         ]);

         // Decode hasil_deteksi JSON
         $hasilDeteksi = json_decode($request->hasil_deteksi, true);

         // Simpan ke database dengan kolom confidence
         $prediksi = Prediksi::create([
             'id_pengajuan' => $request->id_pengajuan,
             'jenis_gambar' => $request->jenis_gambar,
             'hasil_deteksi' => $request->hasil_deteksi, // Simpan JSON asli
             'status' => $request->status,
             'path_gambar' => $request->path_gambar,
             'front_wheel_confidence' => $hasilDeteksi['front_wheel_confidence'] ?? null,
             'handlebar_confidence' => $hasilDeteksi['handlebar_confidence'] ?? null,
             'pedal_confidence' => $hasilDeteksi['pedal_confidence'] ?? null,
             'rear_wheel_confidence' => $hasilDeteksi['rear_wheel_confidence'] ?? null,
             'saddle_confidence' => $hasilDeteksi['saddle_confidence'] ?? null,
         ]);

         return response()->json([
             "success" => true,
             "message" => "Prediksi berhasil disimpan",
             "prediksi" => $prediksi
         ]);
     }


    public function getPengajuanPrediksi($id_pengajuan)
    {
        $pengajuan = Pengajuans::find($id_pengajuan);

        if (!$pengajuan) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan tidak ditemukan'
            ], 404);
        }

        $prediksi = Prediksi::where('id_pengajuan', $id_pengajuan)
            ->whereIn('jenis_gambar', ['tampak_depan', 'tampak_kiri', 'tampak_kanan', 'tampak_belakang'])
            ->where('status', 'valid')
            ->get();

        return response()->json([
            'success' => true,
            'pengajuan' => $pengajuan,
            'prediksi' => $prediksi
        ]);
    }

    public function storePermohonanPenutupan($idPengajuan)
    {
        $pengajuan = Pengajuans::findOrFail($idPengajuan);

        $periodePaket = 12; // 12 bulan (1 tahun)
        $tanggalBerlaku = Carbon::now(); // Tanggal berlaku mulai dari sekarang
        $tanggalBerakhir = $tanggalBerlaku->copy()->addMonths($periodePaket); // Tambah 12 bulan

        // Generate No Referensi (misalnya berdasarkan ID + timestamp)
        $refPenutupan = 'BN' . strtoupper(substr(md5(uniqid()), 0, 8));

        // Simpan data ke tabel `permohonan_penutupan`
        $permohonan = PermohonanPenutupan::create([
            'id_pengajuan'    => $pengajuan->id,
            'ref_penutupan'     => $refPenutupan,
            'produk'          => 'Asuransi Sepeda', // Sesuai dengan jenis produk
            'paket'           => $pengajuan->plan, // Paket asuransi yang dipilih
            'periode_paket'   => $periodePaket . ' Bulan', // Simpan dalam format "12 Bulan"
            'tanggal_berlaku' => $tanggalBerlaku,
            'tanggal_berakhir'=> $tanggalBerakhir,
            'nilai_pertanggungan'=> $pengajuan->harga_sepeda,
            'premi'           => $pengajuan->premi, // Ambil dari pengajuan
        ]);

        // **4️⃣ Kirim Email ke User**
        Mail::to($pengajuan->user->email)->send(new PermohonanPenutupanMail($permohonan));

        return response()->json([
            'success' => true,
            'message' => 'Permohonan penutupan berhasil dibuat.',
            'data' => $permohonan
        ]);
    }

    /**
     * Fungsi untuk menyimpan file ke /public/uploads
     */
    private function saveFile($file, $directory)
    {
        if (!$file) {
            return null;
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $path = public_path($directory);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file->move($path, $filename);

        return "uploads/{$filename}";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Ambil data pengajuan berdasarkan ID
        // $pengajuan = Pengajuans::where('user_id', auth()->id())->latest()->first();

        // Ambil data prediksi terkait pengajuan ini
        // $prediksi = Prediksi::where('pengajuan_id', $pengajuan->id ?? null)->get();
        // return view('pages/pengajuanPolis', compact('pengajuan', 'prediksi'));
    }

    public function keranjang()
    {
        $userId = auth()->id(); // Ambil ID user yang sedang login

        // Ambil data dari tabel pengajuans untuk daftar keranjang (Draft)
        $pengajuans = Pengajuans::select(
                'pengajuans.id',
                'users.nama as nama',
                'pengajuans.plan',
                'pengajuans.premi',
                'pengajuans.created_at'
            )
            ->join('users', 'pengajuans.id_user', '=', 'users.id') // Join ke tabel users
            ->where('pengajuans.status', null) // Status kosong sesuai dengan draft
            ->where('pengajuans.id_user', $userId) // Filter hanya untuk user yang login
            ->orderByDesc('pengajuans.created_at')
            ->get();

        // Ambil data dari tabel pembayarans untuk daftar yang menunggu pembayaran
        $pembayarans = Pembayarans::join('pm_penutupan', 'pembayarans.id_penutupans', '=', 'pm_penutupan.id')
            ->join('pengajuans', 'pm_penutupan.id_pengajuan', '=', 'pengajuans.id') // Ambil id_pengajuan dari pm_penutupan
            ->join('users', 'pengajuans.id_user', '=', 'users.id') // Join ke tabel users
            ->select(
                'pembayarans.id',
                'users.nama as nama',
                'pm_penutupan.ref_penutupan as ref_penutupan',
                'pengajuans.plan',
                'pengajuans.premi',
                'pengajuans.created_at as tanggal_pengajuan',
                'pembayarans.metode_pembayaran as metode'
            )
            ->where('pembayarans.status', 'pending')
            ->where('pengajuans.id_user', $userId) // Filter hanya untuk user yang login
            ->orderByDesc('pengajuans.created_at')
            ->get();

        return view('pages/keranjang', compact('pengajuans', 'pembayarans'));
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function getPengajuan($id) {
        $pengajuan = Pengajuans::where('id', $id)->first();
        $tipesepeda = TipeSepeda::all();
        return view('pages/pengajuanPolis', compact('pengajuan','tipesepeda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updatePengajuan(Request $request) {
        $idUser = auth()->id();

        if (!$idUser) {
            return response()->json([
                'success' => false,
                'message' => 'Anda harus login untuk memperbarui pengajuan'
            ], 401);
        }

        // Validasi input
        $validatedData = $request->validate([
            'id_pengajuan' => 'required|exists:pengajuans,id',
            'harga_sepeda' => 'required|numeric',
            'kode_promo' => 'nullable|string|max:50',
            'plan' => 'required|string',
            'premi' => 'required|numeric',
            'total' => 'required|numeric',
            'merek_sepeda' => 'required|string',
            'warna_sepeda' => 'required|string|max:100',
            'tipe_sepeda' => 'required|exists:tipesepeda,id',
            'no_rangka_sepeda' => 'required|string|max:100',
            'model_sepeda' => 'required|string|max:100',
            'tahun_produksi' => 'required|integer',
            'seri_sepeda' => 'nullable|string|max:50',
            'no_invoice_pembelian' => 'required|string|max:100',
        ]);

        // **Cari pengajuan berdasarkan ID dan pastikan hanya milik user yang sedang login**
        $pengajuan = Pengajuans::where('id', $validatedData['id_pengajuan'])
            ->where('id_user', $idUser)
            ->first();

        if (!$pengajuan) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan tidak ditemukan atau bukan milik Anda'
            ], 404);
        }

        // **Cek apakah no_rangka_sepeda yang baru sudah digunakan oleh pengajuan lain**
        $cekDuplikasi = Pengajuans::where('no_rangka_sepeda', $validatedData['no_rangka_sepeda'])
            ->where('id', '!=', $validatedData['id_pengajuan']) // Pastikan bukan ID yang sedang diedit
            ->where('id_user', $idUser) // Hanya cek dalam pengajuan user saat ini
            ->exists();

        if ($cekDuplikasi) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor rangka sepeda sudah digunakan dalam pengajuan lain'
            ], 422);
        }

        // **Update data pengajuan**
        $pengajuan->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data pengajuan berhasil diperbarui'
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
