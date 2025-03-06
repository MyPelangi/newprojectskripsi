<?php

namespace App\Http\Controllers;

use App\Models\Pengajuans;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index() {
        return response()->json([
            'status' => 'success',
            'data' => []
        ]);
    }

    public function getData() {
        try {
            $data = Pengajuans::all();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
