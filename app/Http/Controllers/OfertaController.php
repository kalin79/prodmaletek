<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use App\Models\Ofertas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfertaController extends Controller
{
    public function index(Marcas $marca){

        return view('pages.marcas.ofertas.index',compact('marca'));
    }
    public function load(Request $request,Marcas $marca){

        if(!$request->ajax()) return redirect('/');

        $ofertas = $marca->ofertas()->orderBy('created_at', 'asc')->paginate(10);
        //dd($relacionadas);
        return view('pages.marcas.ofertas.partials.load',compact('ofertas'));
    }

    public function create(Marcas $marca){

        return view('pages.marcas.ofertas.modals.create',compact('marca'));
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
        DB::beginTransaction();
        try {

            $oferta = Ofertas::create($request->all());
           DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        return response()->json($oferta,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Ofertas $oferta){

        return view('pages.marcas.ofertas.modals.update',compact('oferta'));
    }
    public function update(Request $request,Ofertas $oferta)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {
            //dd($request->all());
            $oferta->update($request->all());


            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        /*$post_route = route('admin.noticia.relacionada.index',$producto_plan->product_id);
        session()->flash('message', 'Los registros se actualizaron satisfactoriamente.');*/

        return response()->json($oferta,202);

    }

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $producto_cobertura = Ofertas::findOrFail($request->id);
        $producto_cobertura->active = false;
        if($producto_cobertura->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $oferta = Ofertas::findOrFail($request->id);
        $oferta->active = true;
        if($oferta->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, Ofertas $oferta){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $oferta->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
}
