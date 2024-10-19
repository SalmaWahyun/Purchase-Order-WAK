<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Error500Controller extends Controller
{
    public function index()
    {
        return view('error-500');
    }
}
