<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index($id)
    {
        return view('pages.frontend.producto')->with('id',$id);;
    }
}
