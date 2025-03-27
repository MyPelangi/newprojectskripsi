<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PolisController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\FlaskPredictionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/cover_note', function () {
    return view('pdf/cover_note');
});
Route::get('/epolis', function () {
    return view('pdf/e_polis');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('pages/home');
    });
    Route::get('/product', function () {
        return view('pages/produk');
    });

    Route::get('/polis', [PolisController::class, 'index']);
    Route::get('/keranjang', [PengajuanController::class, 'keranjang']);
    Route::get('/profil', [SessionController::class, 'profil']);
    Route::get('/product/sepeda/pengajuan', [PengajuanController::class, 'create']);
    Route::post('/hitung-premi', [PengajuanController::class, 'hitungPremi']);
    // Route::post('/storePrediksi', [PengajuanController::class, 'storePrediksi']);
    // Route::post('/storeOCR', [PengajuanController::class, 'storeOCR']);
    Route::post('/storePengajuan', [PengajuanController::class, 'storePengajuan']);
    // Route::put('/api/update-snk', [PengajuanController::class, 'updateSnk']);
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/prosesCheckout', [CheckoutController::class, 'prosesCheckout']);
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');

    Route::get('/getPengajuan/{id}', [PengajuanController::class, 'getPengajuan'])->name('pengajuan.edit');
    Route::post('/updatePengajuan', [PengajuanController::class, 'updatePengajuan']);

    Route::post('/konfirmasi-pembayaran/{id}', [PembayaranController::class, 'konfirmasiPembayaran']);
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});

Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/auth/login', [SessionController::class, 'login']);
Route::get('/register', [SessionController::class, 'register']);
Route::post('/register/createAccount', [SessionController::class, 'createAccount']);

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login']);

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/pengajuanpolis', [AdminController::class, 'pengajuanPolis'])->name('admin.pengajuanpolis');
        Route::get('/prediksi', [AdminController::class, 'prediksi'])->name('admin.prediksi');
        Route::get('/detail/{id}', [AdminController::class, 'show'])->name('detail.show');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
