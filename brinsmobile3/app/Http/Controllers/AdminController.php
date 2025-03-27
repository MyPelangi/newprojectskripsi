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
        $proses = Pengajuans::where('status', 'pending_ocr')->count();
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

        // Kirim data ke view dalam format JSON agar mudah digunakan di JavaScript
        $chartData = [
            'labels' => ['Front Wheel', 'Handlebar', 'Pedal', 'Rear Wheel', 'Saddle'],
            'values' => [
                round($averageAccuracy->avg_front_wheel, 2),
                round($averageAccuracy->avg_handlebar, 2),
                round($averageAccuracy->avg_pedal, 2),
                round($averageAccuracy->avg_rear_wheel, 2),
                round($averageAccuracy->avg_saddle, 2)
            ],
            'totalAvg' => round($totalAvgAccuracy, 2)
        ];

        $prediksi = Prediksi::count();
        $prediksiValid = Prediksi::where('status', 'valid')->count();
        $prediksiInvalid = Prediksi::where('status', 'invalid')->count();

        $chartDataPrediksi = [
            'labels' => ['Valid Predictions', 'Invalid Predictions'],
            'values' => [$prediksiValid, $prediksiInvalid],
            'total' => $prediksi
        ];

        // Menghitung jumlah status 'valid' dan 'invalid' per tanggal
        $data = Prediksi::selectRaw(
            'DATE(created_at) as date,
            SUM(CASE WHEN status = "valid" THEN 1 ELSE 0 END) as valid,
            SUM(CASE WHEN status = "invalid" THEN 1 ELSE 0 END) as invalid'
        )
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Format data untuk Chart.js
        $labels = $data->pluck('date');
        $valuesvalid = $data->pluck('valid');
        $valuesinvalid = $data->pluck('invalid');

        // Menghitung rata-rata akurasi per hari
        $accuracyData = Prediksi::selectRaw(
            'DATE(created_at) as date,
            AVG(NULLIF(front_wheel_confidence, "-")) as avg_front_wheel,
            AVG(NULLIF(handlebar_confidence, "-")) as avg_handlebar,
            AVG(NULLIF(pedal_confidence, "-")) as avg_pedal,
            AVG(NULLIF(rear_wheel_confidence, "-")) as avg_rear_wheel,
            AVG(NULLIF(saddle_confidence, "-")) as avg_saddle,
            AVG((
                NULLIF(front_wheel_confidence, "-") +
                NULLIF(handlebar_confidence, "-") +
                NULLIF(pedal_confidence, "-") +
                NULLIF(rear_wheel_confidence, "-") +
                NULLIF(saddle_confidence, "-")
            ) / 5) as avg_accuracy'
        )
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Format data untuk Chart.js
        $accuracyLabels = $accuracyData->pluck('date');
        $accuracyValues = $accuracyData->pluck('avg_accuracy');

        return $dataTable->render('admin.dashboard_prediksi', compact(
            'chartDataPrediksi',
            'chartData',
            'labels',
            'valuesvalid',
            'valuesinvalid',
            'accuracyLabels',
            'accuracyValues'
        ));
    }

    public function show($id)
    {
        $data = Pengajuans::with([
            'user',
            'tipeSepeda',
            'pembayaran',
            'prediksi' => function ($query) {
                $query->where('status', 'valid')->latest(); // Hanya prediksi valid
            }
        ])->findOrFail($id);
        return view('admin.detail', compact('data'));
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}

