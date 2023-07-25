<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Filters\User\UsuarioFilter;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{
    public function index(Request $request){
       /* if( Gate::denies('user_access') ) {
            return abort(401);
        }*/
        if ($request)
        {
            $breadcrumb = [
                [
                    'name' => 'Administradores',
                    'url' => route( 'administrator.index' )
                ],
                [
                    'name' => 'Listado',
                    'url' => '#'
                ]
            ];
            $roles = Role::pluck('title','id');
        	return view('pages.user.index',['roles'=>$roles,"breadcrumb"=>$breadcrumb]);
        }
    }
    public function load(UsuarioFilter $filters){

        $users = User::where('users.active','<>',2)->with('role')
        			->orderBy('users.created_at', 'asc')->filterDynamic($filters)
                    ->paginate(10);
        //dd($users);
        return view('pages.user.partials.load',compact('users'));
    }

    public function create(){
        /*if( Gate::denies('user_create') ) {
            return response()->json('',401);
        }*/
        $roles = Role::where('active','=',1)->orderBy('title','asc')->get()->pluck('title','id');

        return view('pages.user.create',compact('roles'));
    }

    public function store(StoreUsersRequest $request){
        /*if( Gate::denies('user_create') ) {
            return response()->json('',401);
        }*/
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->active = 1;
        $user->save();
        $user->role()->sync($request->input('role', []));



        return response()->json(true);

    }

    public function edit(User $user){
        /*if( Gate::denies('user_edit') ) {
            return response()->json('',401);
        }*/
        $roles = Role::where('active',1)->orderBy('title','asc')->get()->pluck('title','id');
        return view('pages.user.update',compact('user','roles'));

    }

    public function update(UpdateUsersRequest $request,User $user) {
        /*if( Gate::denies('user_edit') ) {
            return response()->json('',401);
        }*/
        $user->name = $request->nombre;
        $user->email = $request->email;
        if(isset($request->password) && $request->password!=""){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        //dd($request->input('role', []));
        $user->role()->sync($request->input('role', []));

        return response()->json(true);
    }

    public function delete(Request $request){

        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        DB::beginTransaction();
        try {

            $user->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);

    }

    public function active(Request $request){
        $user = User::findOrFail($request->id);
        $user->active = 1;
        if($user->save()){

            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $user = User::findOrFail($request->id);
        $user->active = 0;
        if($user->save()){

            return response()->json(["rpt"=>1]);
        }
    }

}
