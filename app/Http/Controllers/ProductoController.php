<?php

namespace App\Http\Controllers;

use App\Http\Enums\TypeCantidadCajones;
use App\Http\Enums\TypeCantidadPuertas;
use App\Http\Enums\TypeCantidadCuerpos;
use App\Http\Enums\TypeChapas;
use App\Http\Enums\TypeMaterial;
use App\Http\Enums\TypeCantidadBandejas;
use App\Http\Enums\TypeSistemaCombustible;
use App\Http\Enums\TypeTransmision;
use App\Http\Filters\Producto\ProductoFilter;
use App\Models\Category;
use App\Models\Colores;
use App\Models\Marcas;
use App\Models\ProductImage;
use App\Models\Producto;
use App\Models\ProductoColor;
use App\Models\ProductoTipos;
use App\Models\Rubros;
use App\Models\Tipos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class ProductoController extends Controller
{
    public function index()
    {
        return view('pages.producto.index');
    }
    public function load(ProductoFilter $filters,Request $request)
    {
        $productos = Producto::filterDynamic($filters)->withCount(['relationProduct','colores'])->orderBy('title_small')->paginate(30);
        return view('pages.producto.partials.load', compact('productos'));
    }

    public function create()
    {
        $tipos_cantidad_puertas = Tipos::byMasterId(TypeCantidadPuertas::master())->get();
        $tipos_cantidad_cuerpos = Tipos::byMasterId(TypeCantidadCuerpos::master())->get();
        $tipos_cantidad_cajones = Tipos::byMasterId(TypeCantidadCajones::master())->get();
        $tipos_material = Tipos::byMasterId(TypeMaterial::master())->get();
        $tipos_cantidad_bandejas = Tipos::byMasterId(TypeCantidadBandejas::master())->get();
        $tipos_cerradura = Tipos::byMasterId(TypeChapas::master())->get();
        //$rubros = Tipos::byMasterId(TypeEstilos::master())->get();*/

        $categorias = Category::activos()->get();

        $rubros = Rubros::activos()->get();

        $colores = Colores::all();

        return view('pages.producto.create', compact('categorias',  'colores','tipos_cantidad_puertas','tipos_cantidad_cuerpos','tipos_cantidad_cajones','tipos_material','tipos_cantidad_bandejas','rubros','tipos_cerradura'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


        $data = $request->all();

        $slug = Str::slug($data['title_large']);
        if (Producto::where('slug', $slug)->withTrashed()->count() > 0) {
            $slug = Str::slug($data['title_large'] . "-" . rand(99, 9999));
        }

        $data['slug'] = $slug;
        //dd($data);
        $product = Producto::create($data);
        $product->storeGallery($request->file('gallery'));

        $color_ids = $request->color_ids?? [];
        foreach ($color_ids as $key => $value) {
            ProductoColor::create(['producto_id'=>$product->id,'color_id'=>$value]);
        }

        /*$tipo_motos_ids = $request->tipo_motos_id?? [];
        foreach ($tipo_motos_ids as $key => $tipo_id) {
            ProductoTipos::create(['producto_id'=>$product->id,'tipo_moto_id'=>$tipo_id]);
        }*/
        $product->updateFichaTecnica($request->file('ficha_pdf'));
        $product->updateImageCover($request->file('imagen_cover'));
        $post_route = route('producto.index');
        session()->flash('message', 'Registro creado satisfactoriamente.');
        return response()->json(['route' => $post_route]);
    }
    public function edit(Request $request, Producto $product)
    {

        $tipos_cantidad_puertas = Tipos::byMasterId(TypeCantidadPuertas::master())->get();
        $tipos_cantidad_cuerpos = Tipos::byMasterId(TypeCantidadCuerpos::master())->get();
        $tipos_cantidad_cajones = Tipos::byMasterId(TypeCantidadCajones::master())->get();
        $tipos_material = Tipos::byMasterId(TypeMaterial::master())->get();
        $tipos_cantidad_bandejas = Tipos::byMasterId(TypeCantidadBandejas::master())->get();
        $tipos_cerradura = Tipos::byMasterId(TypeChapas::master())->get();
        $colores = Colores::all();
        $rubros = Rubros::activos()->get();
        $colores_producto =$product->colores()->get()->pluck('color_id')->toArray();
        $categorias = Category::activos()->get();
        return view('pages.producto.edit', compact('tipos_cantidad_puertas','tipos_cantidad_cuerpos','tipos_cantidad_cajones','tipos_material','tipos_cantidad_bandejas', 'colores', 'product','colores_producto','categorias','rubros','tipos_cerradura'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $product)
    {
        if (!$request->ajax()) return redirect('/');
        /*DB::beginTransaction();
        try {*/
            $data = $request->all();
            //dd($data);
            $slug = Str::slug($data['title_large']);
            if (Producto::where('slug', $slug)->where("id", "!=", $product->id)->withTrashed()->count() > 0) {
                $slug = Str::slug($data['title_large'] . "-" . rand(99, 9999));
            }
            $data['slug'] = $slug;

            //$product = Product::findOrFail($id);

            $product->update($data);
            $product->updateGallery($request->file('gallery'));


            if($request->color_ids){
                /****************Eliminando areas ***********/
                $tags_noticia = $product->colores;
                $tags_data = Colores::whereIn("id",$request->color_ids)->get()->pluck('id')->toArray();
                $tags_noticas_data = ProductoColor::where("producto_id",$product->id)->whereIn('color_id',$tags_data)->get()->pluck('producto_id','id')->toArray();
                $array_tags_noticia_id = $tags_noticia ? $tags_noticia->pluck('id')->toArray() : [];
                $array_tags_data_id= count($tags_noticas_data) ? array_keys($tags_noticas_data):[];
                $tags_noticia_id_delete = array_diff($array_tags_noticia_id,$array_tags_data_id);
                if(count($tags_noticia_id_delete)){
                    $product->colores()->where("producto_id",$product->id)->whereIn('id',$tags_noticia_id_delete)->delete();
                }
                foreach($request->color_ids as $color_id){

                    $producto_colores = ProductoColor::where('producto_id',$product->id)->where('color_id',$color_id)->first();
                    if(!$producto_colores){
                        ProductoColor::create([
                            'producto_id'=> $product->id,
                            'color_id'=>$color_id
                        ]);
                    }

                }
            }

            if($request->tipo_motos_id){
                /****************Eliminando areas ***********/
                $producto_tipos = $product->tiposMoto;
                $tipos_motos = Tipos::whereIn("id",$request->tipo_motos_id)->get()->pluck('id')->toArray();
                $producto_tipos_data = ProductoTipos::where("producto_id",$product->id)->whereIn('tipo_moto_id',$tipos_motos)->get()->pluck('producto_id','id')->toArray();
                $array_tproducto_tipos_data_id = $producto_tipos ? $producto_tipos->pluck('id')->toArray() : [];
                $array_tipos_data_id= count($producto_tipos_data) ? array_keys($producto_tipos_data):[];
                $producto_tipos_id_delete = array_diff($array_tproducto_tipos_data_id,$array_tipos_data_id);
                if(count($producto_tipos_id_delete)){
                    $product->tiposMoto()->where("producto_id",$product->id)->whereIn('id',$producto_tipos_id_delete)->delete();
                }
                foreach($request->tipo_motos_id as $color_id){

                    $producto_tipos_motos = ProductoTipos::where('producto_id',$product->id)->where('tipo_moto_id',$color_id)->first();
                    if(!$producto_tipos_motos){
                        ProductoTipos::create([
                            'producto_id'=> $product->id,
                            'tipo_moto_id'=>$color_id
                        ]);
                    }

                }
            }

            $product->updateFichaTecnica($request->file('ficha_pdf'));
            $product->updateImageCover($request->file('imagen_cover'));
          /*  DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();
            return response()->json("ocurrio un error inesperado", 500);
            //abort(500);
        }*/
        $post_route = route('producto.edit',$product->id);
        session()->flash('message', 'Registro actualizado satisfactoriamente.');
        return response()->json(['route' => $post_route]);
    }
    public function destroy($id)
    {
        /*if (Gate::denies('product_delete')) {
            return abort(401);
        }*/

        $product = Producto::findOrFail($id);
        $product->delete();

        return response()->json(["rpt" => 1]);
    }
    public function active(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->active = 1;
        if ($producto->save()) {

            return response()->json(["rpt" => 1]);
        }
    }
    public function desactivePopular(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->es_mas_popular = 0;
        if ($producto->save()) {

            return response()->json(["rpt" => 1]);
        }
    }

    public function activePopular(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->es_mas_popular = 1;
        if ($producto->save()) {

            return response()->json(["rpt" => 1]);
        }
    }

    public function desactiveVisto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->es_mas_visto = 0;
        if ($producto->save()) {

            return response()->json(["rpt" => 1]);
        }
    }

    public function activeVisto(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->es_mas_visto = 1;
        if ($producto->save()) {

            return response()->json(["rpt" => 1]);
        }
    }
    public function desactive(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->active = 0;
        if ($producto->save()) {

            return response()->json(["rpt" => 1]);
        }
    }

    public function updateActivated(Request $request, $id)
    {

        $product = Producto::findOrFail($id);

        $product->active = ($request->get('active') === "true") ? true : false;
        $product->save();
        /*return (new ProductResource($product))
            ->response()
            ->setStatusCode(202);*/
    }

    public function loadImages(Request $request)
    {


        $images = [];

        $product = Producto::findOrFail($request->id);
        if ($product->poster) {
            $images[] = [
                'id' => -1,
                'image' => $product->poster,
                'type' => 'principal'
            ];
        }

        /*$productImages = ProductImageLoad::collection($product->productImages->whereNull('deleted_at')->sortBy('order'));
        foreach ($productImages as $product_image) {
            if (!empty($product_image->image)) {
                $images[] = [
                    'id' => $product_image->id,
                    'image' => $product_image->image,
                    'type' => 'gallery',
                    'temp' => false
                ];
            }
        }*/

        return response()->json([
            'images' => $images
        ]);
    }

    public function loadGallery(Producto $product)
    {
        $gallery = $product->loadGallery();
        return view('pages.producto.partials.load-gallery', compact('gallery', 'product'));
    }

    public function updateOrderImageGallery(Request $request)
    {
        $ids = $request->page_id_array;
        $gallery = ProductImage::whereIn('id', $ids)->orderby('order', 'asc')->get();
        $min = $gallery->min('order');

        $min = $min === 0 ? 1 : $min;

        foreach ($gallery as $image) {
            $key = array_search($image->id, $ids);
            if (!is_bool($key)) {
                $image->order = $min + $key;
                $image->save();
                if($image->order==1){
                    $producto = Producto::find($image->product_id);
                    $producto->update([
                        'poster' => $image->image
                    ]);
                }
            }
        }
    }

    public function destroyImageGallery(Request $request, Producto $product, ProductImage $product_image)
    {
        if (!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {
            $product_image->delete();
            ProductImage::reorder($product->id);
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }

        return response()->json(["rpt" => 1]);
    }

    public function showFile(Producto $producto){
        $file = public_path('images/products/'.$producto->id.'/documentos/'.$producto->ficha_tecnica) ;
        //dd($file);
        if (File::isFile($file))
        {
            $file = File::get($file);

            $response = Response::make($file, 200);

            $response->header('Content-Type', 'application/pdf');

            return $response;
        }else{
            abort(404, 'No se encontro archivo');
        }
    }
}
