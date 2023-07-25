<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{
    public function index(Request $request,Category $category){
       //dd($category->id);
        return view('pages.categorias.index',compact('category'));
    }
    public function load(Request $request){

    	if(!$request->ajax()) return redirect('/');
        //dd($request->parent_id);
        $categorias = Category::finterAndPaginate('',$request->parent_id);
        $parent_id = $request->parent_id ? $request->parent_id : 0;
        return view('pages.categorias.partials.load',compact('categorias','parent_id'));
    }



    public function create(Request $request){
        //dd($request->parent_id);
        $parent_id = $request->parent_id ? $request->parent_id : 0;
        return view('pages.categorias.modals.create',compact('parent_id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        if(!$request->ajax()) return redirect('/');
        //if($request->parent_id==0)
        $count = Category::where('parent_id',$request->parent_id)->count();

        $data = $request->all();
        $data['slug'] = Str::slug($data['name']);
        $category = Category::create($data);
        $category->updateImages($request->file('images'));
        $category->updateIcon($request->file('icon'));
        $category->position = $count+1;
        $category->save();

        return response()->json($category,201);
    }
    public function edit(Request $request, Category $category){

        return view('pages.categorias.modals.edit',compact('category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['slug'] = Str::slug($data['name']);
            $category->update($data);
            $category->updateImages($request->file('images'));
            $category->updateIcon($request->file('icon'));
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        return response()->json($category,202);


    }

    /*public function show(Request $request, Slider $banner){

        return view('pages.banners.show',compact('banner'));
    }*/

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $category = Category::findOrFail($request->id);
        $category->active = 0;
        if($category->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $category = Category::findOrFail($request->id);
        $category->active = 1;
        if($category->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, Category $category){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $category->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }

    public function updateOrder(Request $request){
        $ids = $request->page_id_array;
        $categories = Category::whereIn( 'id', $ids )->where('parent_id', $request->parent_id)->orderby('position', 'asc')->get();
        $min = $categories->min('position');

        $min = $min === 0 ? 1 : $min;

        foreach ($categories as $category) {
            $key = array_search($category->id, $ids);
            if (!is_bool($key)) {
                $category->position = $min + $key;
                $category->save();
            }
        }
    }

    public function getListSubCategorias(Request $request){
        //dd($request->all());
        $sub_categorias = Category::where('parent_id', $request->parent_ids)->orderby('position', 'asc')->get();
        return view('pages.categorias.partials.list-subcategorias',compact('sub_categorias'));
    }

    public function getListCategory(){
        $categorias = Category::where('parent_id', 0)->orderby('position', 'asc')->get();
        foreach ($categorias as $categoria)
        {
            $categoria->nombre = $categoria->name;
        }
        return response()->json($categorias);
    }

}
