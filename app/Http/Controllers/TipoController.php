<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\CategoriaTipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = new Tipo();
        $tipos = $tipos->orderBy('id_categoria_tipo','ASC')->orderBy('nombre','ASC')->get();
        return view('page.admin.tipo.listado')->with('tipos',$tipos);
    }

    public function papelera(Request $request)
    {
        Tipo::find($request->id)->delete();   
        
        return redirect('/admin/tipos/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = new CategoriaTipo();
        $categorias = $categorias->orderBy('nombre','ASC')->get();

        return view('page.admin.tipo.crear')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:40|min:2|unique:categorias',
            'id_categoria_tipo' => 'required',
        ]);  

        $tiposDB = Tipo::create([
            'id_categoria_tipo' => $datos["id_categoria_tipo"],
            'nombre' => $datos["nombre"],
            'valor' => $request["valor"]
        ]);

        // dd();
        

        return redirect('/admin/tipos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo $tipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Tipo $tipo)
    {
        
        $categorias = new CategoriaTipo();
        $categorias = $categorias->orderBy('nombre','ASC')->get();

        $tipo = $tipo->where('id',$id)->first();
        // dd($tipo);
        return view('page.admin.tipo.editar')->with('categorias',$categorias)->with('tipo',$tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo $tipo)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:40|min:2|unique:categorias',
            'id_categoria_tipo' => 'required',
        ]);  

        $update = Tipo::find($request["id"]);
        $update->nombre = $datos["nombre"];
        $update->id_categoria_tipo = $datos["id_categoria_tipo"];
        $update->valor = $request["valor"];
        $update->save();

        return redirect('/admin/tipos/editar/'.$request["id"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo $tipo)
    {
        //
    }
}
