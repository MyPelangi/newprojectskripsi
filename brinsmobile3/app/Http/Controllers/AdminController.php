<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Polis;
use App\Models\Prediksi;
use App\Models\Pengajuans;
use App\Models\Pembayarans;
use Illuminate\Http\Request;
use App\Mail\SPPAApprovedMail;
use App\Mail\SPPARejectedMail;
use Illuminate\Support\Facades\DB;
use App\Models\PermohonanPenutupan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\DataTables\PrediksiDataTable;
use App\DataTables\PengajuansDataTable;
use App\DataTables\PembayaransDataTable;
use App\DataTables\PermohonanPenutupanDataTable;

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
        $permohonan = PermohonanPenutupan::count();

        $totalAvgAccuracy = DB::table('prediksi')
            ->selectRaw('
                AVG((NULLIF(front_wheel_confidence, "-") +
                NULLIF(handlebar_confidence, "-") +
                NULLIF(pedal_confidence, "-") +
                NULLIF(rear_wheel_confidence, "-") +
                NULLIF(saddle_confidence, "-")) / 5) as avg_accuracy
            ')
            ->value('avg_accuracy');

        $penutupan = Polis::count();

        // chart pengajuan berdasarkan merk sepeda
        $merk_sepeda = DB::table('pengajuans')
        ->select('merek_sepeda', DB::raw('count(*) as total'))
        ->groupBy('merek_sepeda')
        ->get();

        $labels = $merk_sepeda->pluck('merek_sepeda');
        $totals = $merk_sepeda->pluck('total');

         // Ambil data DITOLAK
        $ditolak = DB::table('pm_penutupan')
            ->join('pengajuans', 'pm_penutupan.id_pengajuan', '=', 'pengajuans.id')
            ->where('pm_penutupan.status_permohonan', 'Ditolak')
            ->select('pengajuans.merek_sepeda', DB::raw('count(*) as total'))
            ->groupBy('pengajuans.merek_sepeda')
            ->get();

        // Ambil data DITERIMA
        $disetujui = DB::table('pm_penutupan')
            ->join('pengajuans', 'pm_penutupan.id_pengajuan', '=', 'pengajuans.id')
            ->where('pm_penutupan.status_permohonan', 'Disetujui')
            ->select('pengajuans.merek_sepeda', DB::raw('count(*) as total'))
            ->groupBy('pengajuans.merek_sepeda')
            ->get();

        $labels_ditolak = $ditolak->pluck('merek_sepeda');
        $data_ditolak = $ditolak->pluck('total');
        $labels_disetujui = $disetujui->pluck('merek_sepeda');
        $data_disetujui = $disetujui->pluck('total');

        $pengajuanharian = Pengajuans::select(
            DB::raw("DATE(created_at) as tanggal"),
            DB::raw("COUNT(*) as total")
        )
        ->groupBy(DB::raw("DATE(created_at)"))
        ->orderBy('tanggal', 'ASC')
        ->get();

        // Format data untuk Chart.js
        $tanggalpengajuan = $pengajuanharian->pluck('tanggal');
        $totalpengajuan = $pengajuanharian->pluck('total');

        return $dataTable->render('admin.dashboard',
            compact(
                'pengajuan',
                'permohonan',
                'totalAvgAccuracy',
                'penutupan',
                'labels',
                'totals',
                'labels_ditolak',
                'data_ditolak',
                'labels_disetujui',
                'data_disetujui',
                'tanggalpengajuan',
                'totalpengajuan'
            )); // Kirim data ke view
    }

    public function permohonanpenutupan(PermohonanPenutupanDataTable $dataTable) {
        $permohonan = PermohonanPenutupan::count();
        $pending = PermohonanPenutupan::where('status_permohonan', 'pending')->count();
        $approved = PermohonanPenutupan::where('status_permohonan', 'disetujui')->count();
        $rejected = PermohonanPenutupan::where('status_permohonan', 'ditolak')->count();
        return $dataTable->render('admin.dashboard_penutupan', compact('permohonan','pending', 'approved', 'rejected'));

    }

    public function action($id) {

        return view('admin.partials.action');

    }


    public function approve($id) {
        $penutupan = PermohonanPenutupan::with('pengajuan.user')->findOrFail($id);
        $penutupan->status_permohonan = 'disetujui';
        $penutupan->tanggal_approval = now();
        $penutupan->updated_by = auth('admin')->user()->id;
        $penutupan->save();

        // Kirim email notifikasi ke user
        Mail::to($penutupan->pengajuan->user->email)->send(new SPPAApprovedMail($penutupan));

        return redirect()->back()->with('success', 'Permohonan disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:500'
        ]);

        $penutupan = PermohonanPenutupan::with('pengajuan.user')->findOrFail($id);
        $penutupan->status_permohonan = 'ditolak';
        $penutupan->tanggal_approval = now();
        $penutupan->keterangan = $request->keterangan;
        $penutupan->updated_by = auth('admin')->user()->id;
        $penutupan->save();

        // Kirim email notifikasi ke user
        Mail::to($penutupan->pengajuan->user->email)->send(new SPPARejectedMail($penutupan));

        return redirect()->back()->with('success', 'Permohonan ditolak.');
    }

    public function pengajuanPolis(PembayaransDataTable $dataTable) {
        $proses = Pengajuans::where('status', 'pending_ocr')->count();
        $menunggupembayaran = Pembayarans::where('status', 'pending')->count();
        $selesai = Pembayarans::where('status', 'lunas')->count();

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
                AVG((NULLIF(front_wheel_confidence, "-") +
                NULLIF(handlebar_confidence, "-") +
                NULLIF(pedal_confidence, "-") +
                NULLIF(rear_wheel_confidence, "-") +
                NULLIF(saddle_confidence, "-")) / 5) as avg_accuracy
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

