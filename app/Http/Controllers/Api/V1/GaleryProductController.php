<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BannerCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Producto;
use App\Models\Rubros;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
class GaleryProductController extends Controller
{
    public function productDateEspecial(){
        $products = Product::where('dia_especial',1)->activos()->get();
        $data = [];
        foreach ($products as $product){
            $row = new \stdClass();
            $row->id = $product->id;
            $row->title = $product->title_large ? trim($product->title_large): '';
            $row->price = $product->price_normal;
            $row->price_old = $product->price_online;
            $row->image = !empty($product->poster) ? asset('images/products/' .$product->id.'/'.$product->poster) : '';
            $row->imagemobile = !empty($product->poster_mobile) ? asset('images/products/'.$product->id.'/' . $product->poster_mobile) : '';
            $row->link = '/'.trim($product->slug);
            $data[] = $row;
        }
        $response = [
            'status' => 1,
            'code' => 200,
            'msg' => 'OK',
            'data' => $data,
            'data_error' => []
        ];
        return response()->json( $response );
    }
    public function productByCategories(Request $request){
        $categoria = Category::where('slug',$request->categoria_slug)->where('parent_id',0)->activos()->first();
        if($categoria){
            $products = Producto::where('categoria_id',$categoria->id)->activos();

            $data_categoria= $this->categories($categoria->id);


            $products = $products->paginate(8);
            $data = [];
            foreach ($products as $product){
                $image_galeria_inicial = $product->galleries()->orderBy('order', 'asc')->first() ;

                $image_product=$image_galeria_inicial? $image_galeria_inicial->image : null;
                $row                        = new \stdClass();
                $row->id                    = $product->id;
                $row->rubro                 =$this->rubro($product->rubro_id);
                $row->title                 = $product->title_large ? trim($product->title_large): '';
                $row->codigo                = $product->code ? trim($product->code): '';
                $row->slug                  = $product->slug ? trim($product->slug): '';
                $row->image                 = $image_product ? asset('images/products/' .$product->id.'/'.$image_product) : '';
                $row->image_cover           = !empty($product->image_cover) ? asset('images/products/'.$product->id.'/' . $product->image_cover) : '';
                $row->link                  = 'producto/'.trim($product->slug);
                $data[]= $row;
            }

            $response = [
                'status' => 1,
                'code' => 200,
                'msg' => 'OK',
                'data_category'=>$data_categoria,
                'banner_category'=>$this->bannersByCategory($categoria->id),
                'data' => $data,
                'pagination' => [
                    'total' => $products->total(),
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem()
                ],
                'data_error' => []
            ];
        }else{
            $response = [
                'status' => 0,
                'code' => 200,
                'msg' => 'OK',
                'data' => [],
                'data_error' => ['msg'=>'No se encontro registros']
            ];

        }
        return response()->json( $response );
    }

    public function productByRubro(Request $request){
        $rubro = Rubros::where('slug',$request->rubro_slug)->activos()->first();
        if($rubro){
            $products = Producto::where('rubro_id',$rubro->id)->activos();
            $data_rubro= $this->rubro($rubro->id);
            $products = $products->paginate(8);
            $data = [];
            foreach ($products as $product){
                $image_galeria_inicial = $product->galleries()->orderBy('order', 'asc')->first() ;

                $image_product=$image_galeria_inicial? $image_galeria_inicial->image : null;
                $row                        = new \stdClass();
                $row->id                    = $product->id;
                $row->categoria_id          = $product->categoria_id;
                $row->categoria_slug        = $product->categoria ? $product->categoria->slug : '';
                $row->categoria             = $product->categoria ? $product->categoria->name : '';
                $row->rubro                 = $this->rubro($product->rubro_id);
                $row->title                 = $product->title_large ? trim($product->title_large): '';
                $row->codigo                = $product->code ? trim($product->code): '';
                $row->slug                  = $product->slug ? trim($product->slug): '';
                $row->image                 = $image_product ? asset('images/products/' .$product->id.'/'.$image_product) : '';
                $row->image_cover           = !empty($product->image_cover) ? asset('images/products/'.$product->id.'/' . $product->image_cover) : '';
                $row->link                  = 'producto/'.trim($product->slug);
                $data[]= $row;
            }

            $response = [
                'status' => 1,
                'code' => 200,
                'msg' => 'OK',
                'data_rubro'=>$data_rubro,
                'data' => $data,
                'pagination' => [
                    'total' => $products->total(),
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem()
                ],
                'data_error' => []
            ];
        }else{
            $response = [
                'status' => 0,
                'code' => 200,
                'msg' => 'OK',
                'data' => [],
                'data_error' => ['msg'=>'No se encontro registros']
            ];

        }
        return response()->json( $response );
    }

    public function bannersByCategory($categoria_id){
        $response = [];
        $data = BannerCategory::activos()->where('category_id',$categoria_id)->get();
        if ($data && count($data) > 0) {
            foreach ($data as $banner) {
                $row = new \stdClass();
                $row->id = $banner->id;
                $row->title = $banner->title ? trim($banner->title): '';
                $row->image = !empty($banner->poster) ? asset('images/categories/'.$categoria_id.'/banners/'.$banner->id.'/'.$banner->poster) : '';
                $row->imagemobile = !empty($banner->poster_mobile) ? asset('images/categories/'.$categoria_id.'/banners/'.$banner->id.'/'. $banner->poster_mobile) : '';
                $row->link = trim($banner->link);
                $response[] = $row;
            }
        }

        return $response;
    }

    public function categories($categoria_id){
        $response = [];
        $data = Category::activos()->where('parent_id',0)->where('id',$categoria_id)->orderBy('position')->get();

        if ($data && count($data) > 0) {
            foreach ($data as $categorias) {
                $row = new \stdClass();
                $row->id = $categorias->id;
                $row->categoria = $categorias->name ? trim($categorias->name): '';
                $row->slug = $categorias->slug ? trim($categorias->slug): '';
                $row->image = !empty($categorias->poster) ? asset('images/categorias/' .$categorias->id.'/'.$categorias->poster) : '';
                $row->imagemobile = !empty($categorias->icon) ? asset('images/categorias/'.$categorias->id.'/' . $categorias->icon) : '';
                $response[] = $row;
            }
        }

        return $response;
    }

    public function rubro($rubro_id){

        $rubro = Rubros::activos()->where('id',$rubro_id)->first();
        $response = null;
        if ($rubro) {
            $row = new \stdClass();
            $row->id = $rubro->id;
            $row->rubro = $rubro->nombre ? trim($rubro->nombre): '';
            $row->slug = $rubro->slug ? trim($rubro->slug): '';
            $response = $row;
        }

        return $response;
    }

    public function listSubCategories($categoria){
        $sub_categorias_data = Category::where('parent_id',$categoria->id)->activos()->get();
        $response_sub_cate = [];
        if ($sub_categorias_data && count($sub_categorias_data) > 0) {
            foreach ($sub_categorias_data as $sub_categorias) {
                $row_sub_cate = new \stdClass();
                $row_sub_cate->id = $sub_categorias->id;
                $row_sub_cate->title = $sub_categorias->name ? trim($sub_categorias->name): '';
                $row_sub_cate->slug = trim($sub_categorias->slug);
                $row_sub_cate->link = '/'.trim($categoria->slug).'/'.trim($sub_categorias->slug);
                $row_sub_cate->description = $sub_categorias->description ? trim($sub_categorias->description): '';
                $response_sub_cate[] = $row_sub_cate;

            }
        }



        return $response_sub_cate;
    }
}
