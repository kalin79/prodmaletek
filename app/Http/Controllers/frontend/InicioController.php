<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // dd(2);
        return view('pages.frontend.inicio');
    }
    public function somos()
    {
        // dd(2);
        return view('pages.frontend.somos');
    }
}
