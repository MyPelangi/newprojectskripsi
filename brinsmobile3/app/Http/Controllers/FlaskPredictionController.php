<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlaskPredictionController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'images.ktp' => 'required|image',
    //         'images.invoice' => 'required|image',
    //         'images.depan' => 'required|image',
    //         'images.kiri' => 'required|image',
    //         'images.kanan' => 'required|image',
    //         'images.belakang' => 'required|image',
    //     ]);

    //     try {
    //         $response = Http::attach('depan', file_get_contents($request->file('images.depan')), 'depan.jpg')
    //             ->attach('kiri', file_get_contents($request->file('images.kiri')), 'kiri.jpg')
    //             ->attach('kanan', file_get_contents($request->file('images.kanan')), 'kanan.jpg')
    //             ->attach('belakang', file_get_contents($request->file('images.belakang')), 'belakang.jpg')
    //             ->post('http://127.0.0.1:5000/predict');

    //         if ($response->failed()) {
    //             return response()->json(["success" => false, "message" => "Gagal menghubungi API Flask.", "error" => $response->body()]);
    //         }

    //         return response()->json($response->json());

    //     } catch (\Exception $e) {
    //         return response()->json(["success" => false, "message" => "Error: " . $e->getMessage()]);
    //     }
    // }
}
