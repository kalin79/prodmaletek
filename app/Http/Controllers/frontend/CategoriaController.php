<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index($id)
    {
        return view('pages.frontend.categoria')->with('id',$id);
    }

    public function rubro($id)
    {
        return view('pages.frontend.rubro')->with('id',$id);
    }
}
