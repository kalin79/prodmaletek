<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BannersController extends Controller
{
    public function index(){
        $breadcrumb = [
            [
                'name' => 'Banners',
                'url' => route( 'banner.index' )
            ],
            [
                'name' => 'Listado',
                'url' => '#'
            ]
        ];
        return view('pages.banners.index',compact('breadcrumb'));
    }
    public function load(Request $request){

    	if(!$request->ajax()) return redirect('/');

        $banners = Slider::orderBy('position', 'asc')->paginate(10);
        return view('pages.banners.partials.load',compact('banners'));
    }


    public function create(){

        return view('pages.banners.modals.create');
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
        $data = $request->all();
        $data['position'] = (Slider::where('active', true)->count() + 1);
        $banner = Slider::create($data);
        $banner->updateImages($request->file('images'));
        $banner->updateImageMobile($request->file('image_mobile'));

        return response()->json($banner,201);
    }
    public function edit(Request $request, Slider $banner){

        return view('pages.banners.modals.edit',compact('banner'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Slider $banner)
    {
        if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try {
            $banner->update($request->all());
            $banner->updateImages($request->file('images'));
            $banner->updateImageMobile($request->file('image_mobile'));
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            abort(500);
        }
        return response()->json($banner,202);


    }

    public function show(Request $request, Slider $banner){

        return view('pages.banners.show',compact('banner'));
    }

    public function desactive(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $banner = Slider::findOrFail($request->id);
        $banner->active = 0;
        if($banner->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function active(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $banner = Slider::findOrFail($request->id);
        $banner->active = 1;
        if($banner->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function destroy(Request $request, Slider $banner){
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
        $categories = Slider::whereIn('id',$ids )->orderby('position', 'asc')->get();
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
