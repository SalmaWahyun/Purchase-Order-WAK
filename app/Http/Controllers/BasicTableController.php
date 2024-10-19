<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicTableController extends Controller
{
    public function index()
    {
        return view('basic-table');
    }
}
