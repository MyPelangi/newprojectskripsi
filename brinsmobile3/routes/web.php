<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('pages/dokpendukung');
});

Route::post('/api/store', [FlaskPredictionController::class, 'store'])->name('prediction.store');
