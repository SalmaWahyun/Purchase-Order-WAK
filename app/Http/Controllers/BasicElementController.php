<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicElementController extends Controller
{
    public function index()
    {
        return view('basic_elements');
    }
}
