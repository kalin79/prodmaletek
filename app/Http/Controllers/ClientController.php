<?php

namespace App\Http\Controllers;

use App\Exports\SociosExport;
use App\Http\Filters\Socio\SocioFilter;
use App\Imports\ClientImport;
use App\Models\Socios;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class ClientController extends Controller
{
    public function index(){
        return view('pages.cliente.index');
    }
    public function load(SocioFilter $filters,Request $request){
        $clientes = Socios::filterDynamic($filters)->paginate(20);
        return view('pages.cliente.partials.load',compact('clientes'));
    }
    public function active(Request $request){
        $client = Socios::findOrFail($request->id);
        $client->estado = 1;
        if($client->save()){
            
            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $client = Socios::findOrFail($request->id);
        $client->estado = 0;
        if($client->save()){

            return response()->json(["rpt"=>1]);
        }
    }

    public function getCompras(Request $request, Socios $cliente){
        $compras_soles = $cliente->compras()->where('moneda',604)->get();
        $compras_dolares = $cliente->compras()->where('moneda',840)->get();
        return view('pages.cliente.modals.list-compras-refinanciamiento',compact('compras_soles','compras_dolares'));

    }
    
    public function exportSociosIngreso(){
        return Excel::download(new SociosExport(),'Socios -' . date('Y-m-d') . '.xlsx');
    }

    public function formImportRefinanciados(){
        return view('pages.cliente.modals.import-excel');
    }

    public function  importRefinancimientoSave(Request $request){
        
        ini_set("memory_limit", -1);
        DB::beginTransaction();
        try {
            $import = new ClientImport();
            //dd($request->file_excel);
            $a = Excel::toArray($import, $request->file('file_excel'));
            $import->array($a);
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(true);
    }

    public function listFilterIngreso(){
        $data = [
            ["id"=>1,"nombre"=>"SI"],
            ["id"=>0,"nombre"=>"NO"]
        ];

        return response()->json($data);
    }

    public function formDeleteData(){
        return view('pages.cliente.modals.delete-data');
    }

    public function deleteDataSave(Request $request){
        //dd($request->all());
        DB::beginTransaction();
        try {
            Socios::whereDate('created_at','>=',$request->init_date)->whereDate('created_at','<=',$request->end_date)->delete();
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(true);

    }
}
