<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengajuans;
use App\Models\Pembayarans;
use Illuminate\Http\Request;
use App\Models\PermohonanPenutupan;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuan = Pengajuans::where('id_user', auth()->id())->latest()->first();

        return view('/pages/checkout', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function prosesCheckout(Request $request)
    {
        if (!$request->has('metode_pembayaran')) {
            return response()->json(['error' => 'Metode pembayaran tidak dipilih'], 400);
        }

        // Ambil data pengajuan terbaru dari user
        $pengajuan = Pengajuans::where('id_user', auth()->id())->orderBy('id', 'desc')->first();

        if (!$pengajuan) {
            return response()->json(['error' => 'Tidak ada pengajuan ditemukan.'], 404);
        }

        // Cari id_penutupan berdasarkan id_pengajuan
        $penutupan = PermohonanPenutupan::where('id_pengajuan', $pengajuan->id)->first();

        if (!$penutupan) {
            return response()->json(['error' => 'Tidak ada data penutupan ditemukan.'], 404);
        }

        // Simpan pembayaran
        $pembayaran = Pembayarans::create([
            'id_user' => auth()->id(),
            'id_penutupans' => $penutupan->id, // Pakai id_penutupan yang ditemukan
            'metode_pembayaran' => $request->metode_pembayaran,
            'nomor_va' => $this->generateNomorVA(),
            'total' => $penutupan->premi + 20000,
            'status' => 'pending',
            'batas_waktu' => now()->addDay(),
        ]);

        return response()->json(['id' => $pembayaran->id]);
    }



    // Fungsi untuk generate nomor VA (contoh sederhana)
    private function generateNomorVA()
    {
        return 'BRI' . rand(1000000000, 9999999999);
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
        //
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
