<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
     public function __construct(){
        parent::__construct();
    }
    public function index(Request $request){
        $breadcrumb = [
            [
                'name' => 'Usuario',
                'url' => route( 'user.index' )
            ],
            [
                'name' => 'Listado',
                'url' => '#'
            ]
        ];

    	$buscar = "";
    	if(isset($request->search) && $request->search !=""){
    		$buscar = $request->search;
    	}
    	$pages = Page::with('module')
    				   ->where('pages.status','<>',2)
    				   ->SearchModule($buscar)
    				   ->paginate(10);

        $JS = "PAGEJS";
        $modulos = Module::where('status','=',1)->pluck('name','id');

    	return view('template-mintos.pages.pages.index',compact("pages",'buscar','JS','modulos','breadcrumb'));
    }

    /*public function create(){
    	$modulos = Module::pluck('name','id');
    	return view('admin.pages.create',compact('modulos'));
    }*/

    public function store(Request $request){
    	$pages = new Page();
    	$pages->module_id = $request->modulo;
    	$pages->name = $request->name;
    	$pages->slug = Str::slug($request->name);
    	$pages->url  = $request->url;
    	$pages->save();

    	return redirect()->route('page.index');

    }

    public function edit($id){
    	$page = Page::findOrFail($id);
    	$modulos = Module::where('status','<>',2)->pluck('name','id');
        return response()->json(
            [
                'page' => $page,
                'modulos' => $modulos
            ]
        );
    	//return view('admin.pages.update',compact('page','modulos'));
    }

    public function update(Request $request){
    	$page = Page::findOrFail($request->page_id);
    	$page->module_id = $request->modulo;
    	$page->name = $request->name;
    	$page->slug = Str::slug($request->name);
    	$page->url  = $request->url;
    	$page->save();

    	return redirect()->route('page.index');
    }

     public function delete(Request $request){

        $page = Page::findOrFail($request->id);
        $page->status = 2;
        if($page->save()){
            return response()->json(["rpt"=>1]);
        }

    }

    public function active(Request $request){
        $page = Page::findOrFail($request->id);
        $page->status = 1;
        if($page->save()){
            return response()->json(["rpt"=>1]);
        }
    }

    public function desactive(Request $request){
        $page = Page::findOrFail($request->id);
        $page->status = 0;
        if($page->save()){
            return response()->json(["rpt"=>1]);
        }
    }
}
