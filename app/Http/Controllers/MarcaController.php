<?php

namespace App\Http\Controllers;

use App\Http\Enums\TypeCantidadCajones;
use App\Http\Filters\Marca\MarcaFilter;
use App\Models\Marcas;
use App\Models\Tipos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MarcaController extends Controller
{
    public function index(){
        return view('pages.marcas.index');
    }
    public function load(MarcaFilter $filters,Request $request){
        $marcas = Marcas::filterDynamic($filters)->orderBy('nombre')->paginate(30);
        return view('pages.marcas.partials.load',compact('marcas'));
    }

    public function create(){
        $tipos_marca = Tipos::byMasterId(TypeCantidadCajones::master())->get();
        return view('pages.marcas.modals.create',compact('tipos_marca'));
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


        $data = $request->all();
        //dd($data);
        $slug = Str::slug($data['nombre']);
        if (Marcas::where('slug', $slug)->withTrashed()->count() > 0) {
            $slug = Str::slug($data['nombre'] . "-" . rand(99, 9999));
        }

        $data['slug'] = $slug;
        $marca= Marcas::create($data);
        $marca->updateImages($request->file('logo_principal'));
        $marca->updateLogoDetalle($request->file('icono_detalle'));
        $marca->updateImageDetalle($request->file('image_detalle'));
        $marca->updateImageOrigen($request->file('image_pais'));
        return response()->json($marca,201);
    }
    public function edit(Request $request, Marcas $marca){
        $tipos_marca = Tipos::byMasterId(TypeCantidadCajones::master())->get();
        return view('pages.marcas.modals.update',compact('marca','tipos_marca'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Marcas $marca)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {
            $data = $request->all();
            $slug = Str::slug($data['nombre']);
            if (Marcas::where('slug', $slug)->where("id", "!=", $marca->id)->withTrashed()->count() > 0) {
                $slug = Str::slug($data['nombre'] . "-" . rand(99, 9999));
            }

            $data['slug'] = $slug;
            $marca->update($data);
            $marca->updateImages($request->file('logo_principal'));
            $marca->updateLogoDetalle($request->file('icono_detalle'));
            $marca->updateImageDetalle($request->file('image_detalle'));
            $marca->updateImageOrigen($request->file('image_pais'));
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            return response()->json("ocurrio un error inesperado",500);
            //abort(500);
        }
        return response()->json($marca,202);


    }
    public function active(Request $request){
        $marca = Marcas::findOrFail($request->id);
        $marca->active = 1;
        if($marca->save()){
            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $marca = Marcas::findOrFail($request->id);
        $marca->active = 0;
        if($marca->save()){

            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, Marcas $marca){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $marca->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }
    public function updateOrder(Request $request){
        /*ALTER TABLE `marcas` ADD `position` INT NOT NULL DEFAULT '0' AFTER `tipo_marca`; */
        $ids = $request->page_id_array;
        $marcas = Marcas::whereIn('id',$ids )->where('tipo_marca',$request->tipo)->orderby('position', 'asc')->get();
        $min = $marcas->min('position');

        $min = $min === 0 ? 1 : $min;

        foreach ($marcas as $marca) {
            $key = array_search($marca->id, $ids);
            if (!is_bool($key)) {
                $marca->position = $min + $key;
                $marca->save();
            }
        }
    }

    public function getTipoMarca(){
        $tipos = Tipos::byMasterId(TypeCantidadCajones::master())->get();

        foreach($tipos as $tipo){
            $tipo->nombre = $tipo->name;
        }

        return response()->json($tipos);
    }
    public function getMarcaFilter(){
        $tipos = Marcas::activos()->get();
        return response()->json($tipos);
    }
}
