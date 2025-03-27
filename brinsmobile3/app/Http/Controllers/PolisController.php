<?php

namespace App\Http\Controllers;

use App\Models\Polis;
use Illuminate\Http\Request;

class PolisController extends Controller
{
    public function index()
    {
        $polis = Polis::all();
        return view ('/pages/polis', compact('polis'));
    }


}
