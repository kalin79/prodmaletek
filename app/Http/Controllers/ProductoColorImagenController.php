<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoColorImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoColorImagenController extends Controller
{
    public function index(Producto $product){

        return view('pages.producto.color-image.index',compact('product'));
    }
    public function load(Request $request,Producto $product){

        if(!$request->ajax()) return redirect('/');
        
        $producto_color = $product->colores()->get()->pluck('id')->toArray();
        $color_imagenes = ProductoColorImage::whereIn('producto_color_id',$producto_color)->paginate(10);
        //dd($relacionadas);
        return view('pages.producto.color-image.partials.load',compact('color_imagenes','product'));
    }

    public function create(Producto $product){
        $producto_colores = $product->colores()->get();

        return view('pages.producto.color-image.modals.create',compact('product','producto_colores'));
    }
    
    
    public function store(Request $request)
    {

        if(!$request->ajax()) return redirect('/');
        // DB::beginTransaction();
        //try {
        
        $image_color = ProductoColorImage::create($request->all());
        $image_color->updateImages($request->file('imagen'));
        /*    DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }*/
        /* $post_route = route('admin.noticia.relacionada.index');
         session()->flash('message', 'Los registros se actualizaron satisfactoriamente.');*/
        return response()->json(true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request,ComplementaryProduct $producto_relacionada)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {

            $producto_relacionada->update($request->all());


            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        $post_route = route('admin.noticia.relacionada.index',$producto_relacionada->product_id);
        session()->flash('message', 'Los registros se actualizaron satisfactoriamente.');

        return response()->json(['route' => $post_route]);

    }*/

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $producto_color_image = ProductoColorImage::findOrFail($request->id);
        $producto_color_image->is_default = false;
        if($producto_color_image->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        
        $producto_color_image = ProductoColorImage::findOrFail($request->id);
        $producto_color_image->is_default = true;
        if($producto_color_image->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, ProductoColorImage $producto_color_image){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $producto_color_image->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
}
