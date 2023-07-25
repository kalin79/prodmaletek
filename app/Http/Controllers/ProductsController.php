<?php

namespace App\Http\Controllers;

use App\Http\Filters\Product\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ProductsController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.productos.index');
        //return new ProductResource(Product::finterAndPaginate(request('q'), request('cat'),$paginate,$from,$promotion_rule_id));
    }

    public function load(ProductFilter $filters){
        $productos=Product::finterAndPaginate($filters);
        return view('pages.productos.partials.load',compact('productos'));
    }

    public function create(){
        $categorias = Category::where('parent_id', 0)
                            ->orderBy('position')
                            ->orderBy('name','asc')
                            ->get();
        return view('pages.productos.create',compact('categorias'));
    }

    public function updatePositions(Request $request)
    {


        //$productCategories = ProductCategory::where('categorie_id', $request->get('cat'))->orderBy('position', 'asc');
        if ($request->get('ids')) {
            foreach ($request->get('ids') as $idn => $idProduct) {
                $productCategory = ProductCategory::where('categorie_id', $request->get('cat'))->where('product_id', $idProduct)->first();
                if ($productCategory) {
                    $productCategory->position = ($idn + 1);
                    $productCategory->update();
                }
            }
        }
    }



    public function store(Request $request)
    {

        $data = $request->all();

        //dd($data);
        $slug = Str::slug($data['title_large']);
        if (Product::where('slug', $slug)->withTrashed()->count() > 0) {
            $slug = Str::slug($data['title_large'] . "-" . rand(99, 9999));
        }

        $data['slug'] = $slug;
        //dd($data);
        $product = Product::create($data);
        $product->updateImagePoster($request->file('poster'));
        $product->updateImagePosterMobile($request->file('poster_mobile'));
        $product->storeGallery($request->file('gallery'));

        /*return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);*/


        $post_route = route('products.index');
        session()->flash('message', 'Registro creado satisfactoriamente.');
        return response()->json(['route' => $post_route]);
    }

    public function edit(Product $product){
        //dd($producto);
        $categorias = Category::where('parent_id', 0)
            ->orderBy('position')
            ->orderBy('name','asc')
            ->get();
        $sub_categorias = Category::where('parent_id', $product->categoria_id)
            ->orderBy('position')
            ->orderBy('name','asc')
            ->get();
        return view('pages.productos.edit',compact('categorias','product','sub_categorias'));
    }

    public function update(Request $request, Product $product)
    {
        /*if (Gate::denies('product_edit')) {
            return abort(401);
        }*/
        $data = $request->all();



        $slug = Str::slug($data['title_large']);
        if (Product::where('slug', $slug)->where("id", "!=", $product->id)->withTrashed()->count() > 0) {
            $slug = Str::slug($data['title_large'] . "-" . rand(99, 9999));
        }
        $data['slug'] = $slug;

        //$product = Product::findOrFail($id);
        $product->update($data);
        $product->updateImagePoster($request->file('poster'));
        $product->updateImagePosterMobile($request->file('poster_mobile'));
        $product->updateGallery($request->file('gallery'));
        $post_route = route('products.index');
        session()->flash('message', 'Registro actualizado satisfactoriamente.');
        return response()->json(['route' => $post_route]);
        //return response()->json($product,202);

    }

    public function destroy($id)
    {
        /*if (Gate::denies('product_delete')) {
            return abort(401);
        }*/

        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(["rpt"=>1]);
    }
    public function active(Request $request){
        $producto = Product::findOrFail($request->id);
        $producto->active = 1;
        if($producto->save()){

            return response()->json(["rpt"=>1]);
        }
    }
    public function desactive(Request $request){
        $producto = Product::findOrFail($request->id);
        $producto->active = 0;
        if($producto->save()){

            return response()->json(["rpt"=>1]);
        }
    }

    public function updateActivated(Request $request, $id)
    {
        if (Gate::denies('product_edit')) {
            return abort(401);
        }
        $product = Product::findOrFail($id);

        $product->active = ($request->get('active') === "true") ? true : false;
        $product->save();
        /*return (new ProductResource($product))
            ->response()
            ->setStatusCode(202);*/
    }

    public function loadImages(Request $request)
    {
        if (Gate::denies('product_edit')) {
            return abort(401);
        }

        $images = [];

        $product = Product::findOrFail($request->id);
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

    public function loadGallery(Product $product)
    {
        $gallery =$product->loadGallery();
        return view('pages.productos.partials.load-gallery',compact('gallery','product'));
    }

    public function updateOrderImageGallery(Request $request){
        $ids = $request->page_id_array;
        $gallery = ProductImage::whereIn('id',$ids )->orderby('order', 'asc')->get();
        $min = $gallery->min('order');

        $min = $min === 0 ? 1 : $min;

        foreach ($gallery as $image) {
            $key = array_search($image->id, $ids);
            if (!is_bool($key)) {
                $image->order = $min + $key;
                $image->save();
            }
        }
    }

    public function destroyImageGallery(Request $request, Product $product, ProductImage $product_image)
    {
        if(!$request->ajax()) return redirect('/');

        DB::beginTransaction();
        try {
            $product_image->delete();
            ProductImage::reorder($product->id);
            DB::commit();
        } catch (Exception $exc) {
            DB::rollBack();

            abort(500);
        }

        return response()->json(["rpt"=>1]);
    }
}
