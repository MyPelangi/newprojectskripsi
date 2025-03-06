<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolisController extends Controller
{
    public function index()
    {
        return view ('/pages/polis');
    }
}
