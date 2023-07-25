<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Filters\Role\RoleFilter;
use Exception;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(Request $request){
        $breadcrumb = [
            [
                'name' => 'Roles',
                'url' => route( 'role.index' )
            ],
            [
                'name' => 'Listado',
                'url' => '#'
            ]
        ];
    	
    	return view('pages.role.index',compact("breadcrumb"));
    }

    public function load(RoleFilter $filters){
        $roles = Role::filterDynamic($filters)->paginate(10);
        return view('pages.role.partials.load',compact("roles"));
    }

    public function create(){
    	return view('pages.role.modals.create');
    }

    public function store(Request $request){

        Role::create($request->all());
    	return response()->json(true);

    }

    public function edit(Request $request,Role $role){
        return view('pages.role.modals.edit',compact('role'));
    }

    public function update(Request $request,Role $role){
    	$role->update($request->all());

    	return response()->json(true);
    }

    public function destroy(Request $request, Role $role){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $role->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    } 

    public function active(Request $request){
        $role = Role::findOrFail($request->id);
        $role->active = 1;
        if($role->save()){
            return response()->json(["rpt"=>1]);    
        }
    }

    public function desactive(Request $request){
        $role = Role::findOrFail($request->id);
        $role->active = 0;
        if($role->save()){
            return response()->json(["rpt"=>1]);    
        }
    }
}
