<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public $_page = 'access';
     public $_pageId = 0;
     public function index( Request $request )
     {
 
         if( $request->id <= 0 ){
             return redirect( 'admin/role' )->with( 'error', 'ID Rol no valido' );
         }
 
         $breadcrumb = [
             [
                 'name' => 'Roles',
                 'url' => route( 'role.index' )
             ],
             [
                 'name' => 'Permisos',
                 'url' => '#'
             ]
         ];
         $id_role = $request->id;
         return view('pages.accesos.index',compact('breadcrumb','id_role'));
     }
 
     public function getAccess( Request $request ){
 
        $search = $request->search;
 
        $permisos = Permission::all();
        $role_id = $request->role;
        $role = Role::with(['permission'])->findOrFail($role_id);
        $role_permision = $role->permission()->get()->pluck('id')->toArray();
        //dd($role_permision);
        return view('pages.accesos.partials.load',compact('permisos','role_id','role_permision'));
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  App\Http\Requests\AccessRequest  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         if( ! $request->ajax() ){
             return abort(403, 'Unauthorized action.');
         }
         
         $role = Role::findOrFail($request->role);
         $role_permision = $role->permission()->get()->pluck('id')->toArray();

         //dd($role_permision,$permiso_id,array_diff($role_permision,$permiso_id));
         if ( $request->checked =="true") {
            array_push($role_permision,$request->page);
        }else{
            $permiso_id[]= $request->page;
            $role_permision = array_diff($role_permision,$permiso_id);
        }
        //dd($role_permision);
        $role->permission()->sync($role_permision);
        return response([
            'status' => true,
            'msg'   => 'Operación exitosa.'
        ], 200);
         /*$access = Access::where('role_id', $request->role )
             ->where('page_id', $request->page )
             ->first();
         if ( ! empty( $access->id ) && $access->id > 0 ) {
             if ( $request->checked =="true") {
                 $access->status = 1;
             }else{
                 $access->status = 2;
             }
             if ( $access->save() ) {
                 return response([
                     'status' => true,
                     'msg'   => 'Operación exitos.'
                 ], 200);
             }
         } else {
             $register = new Access();
             $register->role_id = $request->role;
             $register->page_id = $request->page;
             $register->status = 1;
             $register->save();
             if ( $register->save() ) {
                 return response([
                     'status' => true,
                     'msg'   => 'Operación exitosa2.'
                 ], 200);
             }
         }
         return response([
             'status' => false,
             'error' => 'Ocurrio un error en la Base de datos.'
         ], 500 );*/
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         //
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         //
     }
}
