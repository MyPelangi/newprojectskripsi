<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Prediksi;
use App\Models\Pengajuans;
use App\Models\Pembayarans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PermohonanPenutupan;
use Illuminate\Support\Facades\Auth;
use App\DataTables\PrediksiDataTable;
use App\DataTables\PengajuansDataTable;
use App\DataTables\PembayaransDataTable;

class AdminController extends Controller
{
    public function loginForm() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function dashboard(PengajuansDataTable $dataTable) {
        $pengajuan = Pengajuans::count(); // Hitung jumlah pengajuan

        $totalAvgAccuracy = DB::table('prediksi')
            ->selectRaw('
                AVG((NULLIF(front_wheel_confidence, "-") + NULLIF(handlebar_confidence, "-") + NULLIF(pedal_confidence, "-") + NULLIF(rear_wheel_confidence, "-") + NULLIF(saddle_confidence, "-")) / 5) as avg_accuracy
            ')
            ->value('avg_accuracy');

        return $dataTable->render('admin.dashboard', compact('pengajuan', 'totalAvgAccuracy')); // Kirim data ke view
    }


    public function pengajuanPolis(PembayaransDataTable $dataTable) {
        $proses = Pengajuans::where('status', null)->count();
        $menunggupembayaran = Pembayarans::where('status', 'pending')->count();
        $selesai = Pembayarans::where('status', 'selesai')->count();

        return $dataTable->render('admin.dashboard_pengajuan', compact('proses', 'menunggupembayaran', 'selesai'));
    }

    public function prediksi(PrediksiDataTable $dataTable) {
        $averageAccuracy = DB::table('prediksi')
            ->selectRaw('
                AVG(NULLIF(front_wheel_confidence, "-")) as avg_front_wheel,
                AVG(NULLIF(handlebar_confidence, "-")) as avg_handlebar,
                AVG(NULLIF(pedal_confidence, "-")) as avg_pedal,
                AVG(NULLIF(rear_wheel_confidence, "-")) as avg_rear_wheel,
                AVG(NULLIF(saddle_confidence, "-")) as avg_saddle
            ')
            ->first();

        $totalAvgAccuracy = DB::table('prediksi')
            ->selectRaw('
                AVG((NULLIF(front_wheel_confidence, "-") + NULLIF(handlebar_confidence, "-") + NULLIF(pedal_confidence, "-") + NULLIF(rear_wheel_confidence, "-") + NULLIF(saddle_confidence, "-")) / 5) as avg_accuracy
            ')
            ->value('avg_accuracy');

        $prediksiValid = Prediksi::where('status', 'valid')->count();
        $prediksiInvalid = Prediksi::where('status', 'invalid')->count();
        return $dataTable->render('admin.dashboard_prediksi', compact('prediksiValid', 'prediksiInvalid', 'totalAvgAccuracy'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}

