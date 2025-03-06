<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::post('/storeOCR', [PengajuanController::class, 'storeOCR']);
Route::post('/storePrediksi', [PengajuanController::class, 'storePrediksi']);
Route::middleware('auth:sanctum')->post('/storePengajuan', [PengajuanController::class, 'storePengajuan']);

Route::get('/getPengajuanPrediksi/{id_pengajuan}', [PengajuanController::class, 'getPengajuanPrediksi']);
Route::post('/updateSnk', function (Request $request) {
    $request->validate([
        'id_pengajuan' => 'required|integer',
        'snk' => 'required|boolean'
    ]);

    DB::table('pengajuans')
        ->where('id', $request->id_pengajuan)
        ->update(['snk' => $request->snk]);

    return response()->json([
        'success' => true,
        'message' => 'SNK berhasil diperbarui'
    ]);
});
Route::post('/Penutupan/{idPengajuan}', [PengajuanController::class, 'storePermohonanPenutupan']);
// Route::post('/hitung-premi', [PengajuanController::class, 'hitungPremi']);
// Route::post('/prosesCheckout', [CheckoutController::class, 'prosesCheckout']);
// Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
