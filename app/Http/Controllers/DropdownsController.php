<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropdownsController extends Controller
{
    public function index()
    {
        return view('dropdowns');
    }
}
