<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('page.admin.usuario.listado')->with('usuarios',$usuarios);
    }

    public function datos()
    {
        return view('page.admin.usuario.datos');
    }

    public function papelera(Request $request)
    {
        // dd($request->id);
        User::find($request->id)->delete();   
        
        return redirect('/admin/usuarios');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.admin.usuario.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $datos = $request->validate([
            'name' => 'required|string|max:40|min:2',
            'email' => 'required|string|email|unique:users|max:120',
            'password' => 'required|string|min:5',
            'rol' => 'required',
        ]);  

        $mascotaDB = User::create([
            'name' => $datos["name"],
            'email' => $datos["email"],
            'rol' => $datos["rol"],
            'password' => Hash::make($datos["password"]),
        ]);

        return redirect('/admin/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (auth()->user()->email != $request->email)
        {
            $datos = $request->validate([
                'name' => 'required|string|max:40|min:2',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:5',
            ]);    
        }else{
            $datos = $request->validate([
                'name' => 'required|string|max:40|min:2',
                'email' => 'required|string|email',
                'password' => 'required|string|min:5',
            ]); 
        }
        
        $update = User::find(auth()->user()->id);
        $update->name = $datos["name"];
        $update->email = $datos["email"];
        $update->password = Hash::make($datos["password"]);
        $update->save();

        return redirect('/datos');

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
