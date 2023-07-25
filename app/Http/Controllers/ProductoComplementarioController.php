<?php

namespace App\Http\Controllers;

use App\Http\Filters\Product\ProductFilter;
use App\Models\ComplementaryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoComplementarioController extends Controller
{
    public function index(Product $product){

        return view('pages.productos.complementarios.index',compact('product'));
    }
    public function load(Request $request,Product $product){

        if(!$request->ajax()) return redirect('/');

        $relacionadas = $product->complementaryProduct()->orderBy('created_at', 'asc')->paginate(10);
        //dd($relacionadas);
        return view('pages.productos.complementarios.partials.load',compact('relacionadas'));
    }

    public function create(Product $product){

        //dd($product);


        return view('pages.productos.modals.list-product-index');
    }
    public function listProductLoad(ProductFilter $filters,Product $product){
        $relacionadas = $product->complementaryProduct()->get()->pluck('product_complementary_id')->toArray();
        array_push($relacionadas,$product->id);

        $productos = Product::filterDynamic($filters)->whereNotIn('id',$relacionadas)->paginate(5);
        return view('pages.productos.partials.list-product-load',compact('productos','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!$request->ajax()) return redirect('/');
        // DB::beginTransaction();
        //try {
        $request["product_complementary_id"] = $request->product_relation_id;
        //dd($request->all());
        $producto_relacionada = ComplementaryProduct::create($request->all());

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
    public function update(Request $request,ComplementaryProduct $producto_relacionada)
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

    }

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $producto_relacionada = ComplementaryProduct::findOrFail($request->id);
        $producto_relacionada->active = false;
        if($producto_relacionada->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $producto_relacionada = ComplementaryProduct::findOrFail($request->id);
        $producto_relacionada->active = true;
        if($producto_relacionada->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, ComplementaryProduct $producto_relacionada){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $producto_relacionada->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
}
