<?php

namespace App\Http\Controllers;

use App\Http\Filters\Module\ModuleFilter;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Page;

class ModulesController extends Controller
{
   
    public function index(Request $request){
        $breadcrumb = [
            [
                'name' => 'Modulos',
                'url' => route( 'module.index' )
            ],
            [
                'name' => 'Listado',
                'url' => '#'
            ]
        ];
    	return view('pages.module.index',compact('breadcrumb'));
    }

    public function load(ModuleFilter $filters){
        $modules = Module::withCount(['page'=> function ($query) {
                                $query->where('pages.status', '<>', 2);
                            }])->where('status','<>',2)->filterDynamic($filters)
                            ->paginate(10);
        // dd($users);           
        return view('pages.module.partials.load',compact('modules'));
    }

   /* public function create(){
    	return view('admin.module.create');
    }*/

    public function store(Request $request){
    	$modules = new Module();
    	$modules->name = $request->name;
    	$modules->description = $request->description;
    	$modules->save();

    	return redirect()->route('module.index');

    }

    public function edit($id){
    	$module = Module::findOrFail($id);
        return response()->json($module);
    	//return view('admin.module.update',compact('module'));
    }

    public function update(Request $request){
    	$module = Module::findOrFail($request->module_id);
    	$module->name = $request->name;
    	$module->description = $request->description;
    	$module->save();

    	return redirect()->route('module.index');
    }

     public function delete(Request $request){

        
            $module = Module::findOrFail($request->id);
            $module->status = 2;
            if($module->save()){
                return response()->json(["rpt"=>1,"msg"=>'']);    
            }
       
        

    }

    public function active(Request $request){
        $module = Module::findOrFail($request->id);
        $module->status = 1;
        if($module->save()){
            return response()->json(["rpt"=>1]);    
        }
    }

    public function desactive(Request $request){
        $module = Module::findOrFail($request->id);
        $module->status = 0;
        if($module->save()){
            return response()->json(["rpt"=>1]);    
        }
    }
}
