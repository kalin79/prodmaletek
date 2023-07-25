<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\File;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('page.admin.categoria.listado')->with('categorias',$categorias);
    }

    public function papelera(Request $request)
    {
        // dd($request->id);
        Categoria::find($request->id)->delete();   
        
        return redirect('/admin/categorias');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.admin.categoria.crear');
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
            'nombre' => 'required|string|max:40|min:2|unique:categorias',
        ]);  


        $slug = Str::slug($datos["nombre"]);

        $categoryDB = Categoria::create([
            'nombre' => $datos["nombre"],
            'slug' => $slug,
            'descripcion' => $request["descripcion"],
            'descripcion_corta' => $request["descripcion_corta"],
        ]);

        // dd($request->file);

        if ($request->hasFile("foto"))
        {
            $imagen = $request->file("foto");
            
            $nombreimagen = $categoryDB->id . "-foto-" . $slug . time() .".".$imagen->guessExtension();

            $path = Storage::disk('category')->putFileAs($categoryDB->id,$imagen,$nombreimagen);
            
            $imageSave = '/images/category/'.$path;

            $categoryDB->fill([
                'foto' => $imageSave,
            ])->save();
            
        }else{
            // dd("No hay imagen");
        }

        if ($request->hasFile("banner"))
        {
            $imagen2 = $request->file("banner");
            
            $nombreBanner = $categoryDB->id . "-banner-" . $slug . time() .".".$imagen2->guessExtension();

            $path = Storage::disk('category')->putFileAs($categoryDB->id,$imagen2,$nombreBanner);
            
            $imageSave2 = '/images/category/'.$path;

            $categoryDB->fill([
                'banner' => $imageSave2,
            ])->save();
            
        }else{
            // dd("No hay imagen");
        }

        return redirect('/admin/categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Categoria $categoria)
    {
        $categoria = $categoria::all();
        $categoria = $categoria->find($id);

        return view('page.admin.categoria.editar')->with('categoria',$categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        
        // dd($request["id"]);

        $categoria = $categoria::all();
        $categoria = $categoria->find($request["id"]); 
        
        $update = Categoria::find($request["id"]);

        if ($categoria->nombre != $request["nombre"]){
            $datos = $request->validate([
                'nombre' => 'required|string|max:40|min:2|unique:categorias',
            ]);  

            $slug = str_replace("<br>", "", $datos["nombre"]);
            $slug = str_replace("<BR>", " ", $slug);
            // dd($slug);
            $slug = Str::slug($slug);

            $update->nombre = $datos["nombre"];
            $update->slug = $slug;
        }else{
            $slug = $categoria->slug;
        }
        
        $update->descripcion = $request["descripcion"];
        $update->descripcion_corta = $request["descripcion_corta"];
        $update->save();


        if ($request->hasFile("foto"))
        {
            $imagen = $request->file("foto");
            
            $nombreimagen = $categoria->id . "-foto-" . $slug . time() .".".$imagen->guessExtension();

            $path = Storage::disk('category')->putFileAs($categoria->id,$imagen,$nombreimagen);
            
            $imageSave = '/images/category/'.$path;

            $update->fill([
                'foto' => $imageSave,
            ])->save();
            
        }else{
            // dd("No hay imagen");
        }

        if ($request->hasFile("banner"))
        {
            $imagen2 = $request->file("banner");
            
            $nombreBanner = $categoria->id . "-banner-" . $slug . time() .".".$imagen2->guessExtension();

            $path = Storage::disk('category')->putFileAs($categoria->id,$imagen2,$nombreBanner);
            
            $imageSave2 = '/images/category/'.$path;

            $update->fill([
                'banner' => $imageSave2,
            ])->save();
            
        }else{
            // dd("No hay imagen");
        }
        return redirect('/admin/categorias/editar/'.$categoria->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
