<?php

namespace App\Http\Controllers;

use App\Models\ProductoRelacionado;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoRelacionadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $producto = Producto::find($id);
        // $productos = Producto::paginate(1);
        $producto_relacionados = ProductoRelacionado::where('id_producto',$id)->where('estado',1)->get();

        return view('page.admin.producto.complementario.listado')->with('producto',$producto)->with('producto_relacionados',$producto_relacionados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $producto = Producto::find($id);
        $producto_relacionados = ProductoRelacionado::where('id_producto',$id)->where('estado',0)->get();

        // dd($producto_relacionados);
        return view('page.admin.producto.complementario.relacionar')->with('producto',$producto)->with('producto_relacionados',$producto_relacionados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductoRelacionado  $productoRelacionado
     * @return \Illuminate\Http\Response
     */
    public function show(ProductoRelacionado $productoRelacionado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductoRelacionado  $productoRelacionado
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductoRelacionado $productoRelacionado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductoRelacionado  $productoRelacionado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductoRelacionado $productoRelacionado)
    {
        // dd($request);

        $update = $productoRelacionado->where('id_producto',$request["id_producto"])->where("id_producto_relacionado",$request["id_producto_relacionado"])->first();

        $update->estado = $request["estado"];
        $update->save();

        if ($request["estado"] == 0)
            return redirect('/admin/productos/complementarios/'.$request["id_producto"]);
        else
            return redirect('/admin/productos/complementarios/relacionar/'.$request["id_producto"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductoRelacionado  $productoRelacionado
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductoRelacionado $productoRelacionado)
    {
        //
    }
}
