<?php

namespace App\Http\Controllers;

use App\Models\GaleriaProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function default(Request $request)
    {
        // dd($request->id);

        GaleriaProducto::where('id_producto',$request->id_producto)
                        ->update(['default'=>0]);
        

        $update = GaleriaProducto::find($request->id);  

        if ($request->default == 0)
            $update->default = 1;
        else
            $update->default = 0;

        $update->save();
        return redirect('/admin/productos/galerias/'.$request->id_producto);
    }

    public function papelera(Request $request)
    {
        // dd($request->id_producto);
        GaleriaProducto::find($request->id)->delete();   
        
        return redirect('/admin/productos/galerias/'.$request->id_producto);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $producto = Producto::find($request->id);
        // dd($producto);
        return view('page.admin.galeria.listado')->with('producto',$producto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file("foto"));
        foreach($request->file("foto") as $foto)
        {
            $imagen = $foto;
            $namefile = $imagen->getClientOriginalName();

            // $imagen->guessExtension()
            
            $nombreimagen = $request->id_producto . "-gallery-" . time() .$namefile;

            $path = Storage::disk('gallery')->putFileAs($request->id_producto,$imagen,$nombreimagen);
            
            $imageSave = '/images/gallery/'.$path;

            GaleriaProducto::create([
                'id_producto' => $request->id_producto,
                'activo' => 1,
                'default' => 0,
                'foto' => $imageSave,
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GaleriaProducto  $galeriaProducto
     * @return \Illuminate\Http\Response
     */
    public function show(GaleriaProducto $galeriaProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GaleriaProducto  $galeriaProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(GaleriaProducto $galeriaProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GaleriaProducto  $galeriaProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GaleriaProducto $galeriaProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GaleriaProducto  $galeriaProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(GaleriaProducto $galeriaProducto)
    {
        //
    }
}
