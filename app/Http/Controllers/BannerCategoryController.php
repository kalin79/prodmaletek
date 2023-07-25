<?php
namespace App\Http\Controllers;

use App\Models\BannerCategory;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerCategoryController extends Controller
{
    public function index(Category $category)
    {
        $breadcrumb = [
            [
                'name' => 'Categoría' ,
                'url' => route( 'categories.index')
            ],
            [
                'name' => 'Listado de Banners',
                'url' => '#'
            ]
        ];

        return view('pages.categorias.banners.index',compact('breadcrumb','category'));
    }
    public function load(Request $request, Category $category)
    {

        if(!$request->ajax()) return redirect('/');
        $banners = BannerCategory::where('category_id',$category->id)->paginate(10);
        return view('pages.categorias.banners.partials.load',compact('banners','category'));
    }


    public function create(Category $category)
    {
        return view('pages.categorias.banners.modals.create',compact('category'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Request $request)
    {
        //dd($request->all());
        if(!$request->ajax()) return redirect('/');
        $data = $request->all();
        $data['position'] = (BannerCategory::where('active', true)->where('category_id',$category->id)->count() + 1);
        $banner = $category->banners()->create($data);
        $banner->updateImages($category->id,$request->file('images'));
        $banner->updateImageMobile($category->id,$request->file('image_mobile'));

        return response()->json($banner,201);
    }
    public function edit(Request $request, Category $category, BannerCategory $banner){

        return view('pages.categorias.banners.modals.edit',compact('banner','category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category,BannerCategory $banner)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {
            $banner->update($request->all());
            $banner->updateImages($category->id, $request->file('images'));
            $banner->updateImageMobile($category->id, $request->file('image_mobile'));
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        return response()->json($banner,202);


    }

    public function show(Request $request, Category $category, BannerCategory $banner){

        return view('pages.categorias.banners.show',compact('banner','category'));
    }

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $banner = BannerCategory::findOrFail($request->id);
        $banner->active = 0;
        if($banner->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $banner = BannerCategory::findOrFail($request->id);
        $banner->active = 1;
        if($banner->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request,Category $category, BannerCategory $banner){
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {

            $banner->delete();

            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }
        return response()->json(["rpt"=>1]);
    }

    public function updateOrder(Request $request){
        $ids = $request->page_id_array;
        $categories = BannerCategory::whereIn('id',$ids )->orderby('position', 'asc')->get();
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
}
