<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Polis;
use App\Mail\EPolisMail;
use App\Models\Pengajuans;
use App\Models\Pembayarans;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\BuktiPembelianMail;
use App\Models\PermohonanPenutupan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran = Pembayarans::where('id', $id)
                        ->where('id_user', auth()->id())
                        ->firstOrFail();

        return view('pages.pembayaran', compact('pembayaran'));
    }

    public function konfirmasiPembayaran(Request $request, $id)
    {
        $polis = Polis::where('id_user', auth()->id())->get();
        set_time_limit(300);
        $user = auth()->user();

        // **1. Ambil Data Pembayaran**
        $pembayaran = Pembayarans::where('id', $id)
                                 ->where('id_user', $user->id)
                                 ->first();

        if (!$pembayaran) {
            return response()->json(['error' => 'Data pembayaran tidak ditemukan'], 404);
        }

        // **2. Ambil Data Penutupan Asuransi**
        $penutupan = PermohonanPenutupan::where('id', $pembayaran->id_penutupans)->first();

        $pengajuan = Pengajuans::where('id', $penutupan->id_pengajuan)->first();

        if (!$penutupan) {
            return response()->json(['error' => 'Data penutupan tidak ditemukan'], 404);
        }

        if (!$penutupan->tanggal_berlaku || !$penutupan->tanggal_berakhir) {
            return response()->json(['error' => 'Tanggal asuransi tidak valid'], 400);
        }

        // **3. Pastikan Data User Ada**
        if (!$user) {
            Log::error('User tidak ditemukan untuk pembayaran ID: ' . $pembayaran->id);
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        // **4. Generate Nomor Polis**
        $tanggalSekarang = date('Ymd'); // Format YYYYMMDD
        $nomorPolis = "{$user->id}{$pembayaran->id_penutupans}{$tanggalSekarang}{$pembayaran->id}";

        $periodeAsuransi = Carbon::parse($penutupan->tanggal_berlaku)->translatedFormat('d F Y') .
                           ' s.d. ' .
                           Carbon::parse($penutupan->tanggal_berakhir)->translatedFormat('d F Y');

        // **5. Simpan Data Polis**
        $polis = Polis::create([
            'id_pembayaran'     => $pembayaran->id,
            'nomor_polis'       => $nomorPolis,
            'id_user'           => $user->id,
            'nama_pemegang'     => $user->nama,
            'jenis_asuransi'    => $penutupan->produk,
            'paket'             => $penutupan->paket,
            'periode_paket'     => $penutupan->periode_paket,
            'periode_asuransi'  => $periodeAsuransi,
            'nilai_pertanggungan' => $penutupan->nilai_pertanggungan,
            'premi'             => $penutupan->premi,
        ]);

        // **6. Pastikan User Tersedia Sebelum Generate E-Polis**
        if (!$polis->user) {
            Log::error('User tidak ditemukan untuk polis ID: ' . $polis->id);
            return response()->json(['error' => 'User tidak ditemukan untuk polis'], 404);
        }

        // **7. Generate Cover Note & E-Polis**
        $coverNotePath = $this->generateCoverNote($polis, $penutupan, $pembayaran);
        $ePolisPath = $this->generateEPolis($polis, $penutupan, $pembayaran, $pengajuan);

        if (!$coverNotePath || !$ePolisPath) {
            Log::error('Gagal membuat dokumen polis untuk polis ID: ' . $polis->id);
            return response()->json(['error' => 'Gagal membuat dokumen polis'], 500);
        }

        $polis->cover_note_path = $coverNotePath;
        $polis->e_polis_path = $ePolisPath;
        $polis->save();

        // **8. Kirim Email Cover Note & E-Polis**
        try {
            Mail::to($user->email)->send(new BuktiPembelianMail($polis, $penutupan));
            Mail::to($user->email)->send(new EPolisMail($polis));
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal mengirim email'], 500);
        }

        // **9. update status di tabel pembayarans menjadi 'selesai'
        $pembayaran->status = 'lunas'; // Tandai pembayaran sebagai valid
        $pembayaran->save();

        return view ('/pages/home');
    }


    private function generateCoverNote($polis, $penutupan, $pembayaran)
    {
        $pdf = Pdf::loadView('pdf.cover_note', compact('polis', 'penutupan', 'pembayaran'));
        $path = 'cover_notes/' . $polis->nomor_polis . '.pdf';
        Storage::put($path, $pdf->output());
        return $path;
    }

    private function generateEPolis($polis, $penutupan, $pembayaran, $pengajuan)
    {
        $user = User::find($polis->id_user); // Ambil user berdasarkan id_user

        if (!$user) {
            Log::error('User tidak ditemukan untuk polis ID: ' . $polis->id);
            return null; // Hindari error lebih lanjut
        }

        $password = Carbon::parse($user->tgl_lahir)->format('dmY');
        $pdf = Pdf::loadView('pdf.e_polis', compact('polis', 'penutupan', 'pembayaran', 'pengajuan'));

        $path = 'e_polis/' . $polis->nomor_polis . '.pdf';

        // Simpan PDF dengan password
        Storage::put($path, $pdf->output(), ['password' => $password]);

        return $path;
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
