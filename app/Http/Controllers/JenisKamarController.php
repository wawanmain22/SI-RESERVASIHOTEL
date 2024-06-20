<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisKamarController extends Controller
{
    public function index()
    {
        return view('admin.jenis-kamar');
    }
}
