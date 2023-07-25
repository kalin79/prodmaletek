<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Enums\TypeCantidadBandejas;
use App\Http\Enums\TypeCantidadCajones;
use App\Http\Enums\TypeCantidadCuerpos;
use App\Http\Enums\TypeCantidadPuertas;
use App\Http\Enums\TypeChapas;
use App\Http\Enums\TypeMaterial;
use App\Models\Category;
use App\Models\Colores;
use App\Models\Menu;
use App\Models\Producto;
use App\Models\ProductoColor;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Subscription;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Cupones;
use App\Models\Tipos;
use App\Traits\ApiResponser;

use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\DB;

class HomeController  extends Controller
{
    use ApiResponser;

    public function index( ) {

        $data                               = new \stdClass();
        //$data->menu                         = $this->menu();
        $data->slider                       = $this->banners();
        $data->categories                   = $this->categories();
        $data->recently_entered_products     = $this->products();

        $status = 1;
        $code   = 200;
        $data   = $data;

        return $this->apiResponse($status,$code,$data);
    }

    public function menu(){
        $response = [];
        $menus = Menu::where('active', 1)->orderBy('position', "asc")->orderBy('name','asc')->get();

        if ($menus && count($menus) > 0) {
            foreach ($menus as $menu) {
                $row = new \stdClass();
                $row->id           = $menu->id;
                $row->name         = $menu->name ? trim($menu->name): '';
                $row->special_date = $menu->fecha_especial;
                $row->icon         = !empty($menu->icon) ? asset('images/menus/' . $menu->icon) : '';
                $row->link         = trim($menu->link);
                $response[]        = $row;
            }
        }
        $data                               = new \stdClass();
        $data->menu                         = $response;
        $data->categories                   = $this->categories();
        $status = 1;
        $code   = 200;

        return $this->apiResponse($status,$code,$data);
    }

    public function banners(){
        $response = [];
        $data = Slider::activos()->orderBy('position')->get();
        if ($data && count($data) > 0) {
            foreach ($data as $banner) {
                $row = new \stdClass();
                $row->id = $banner->id;
                $row->title = $banner->title ? trim($banner->title): '';
                $row->descripcion = $banner->description ? trim($banner->description): '';
                $row->accion = $banner->button ? trim($banner->button): '';
                $row->image = !empty($banner->poster) ? asset('images/banners/' .$banner->id.'/'.$banner->poster) : '';
                $row->imagemobile = !empty($banner->poster_mobile) ? asset('images/banners/'.$banner->id.'/' . $banner->poster_mobile) : '';
                $row->icono = $banner->icono ? trim($banner->icono): '';
                $row->link = trim($banner->link);
                $response[] = $row;
            }
        }

        return $response;
    }

    public function categories(){
        $response = [];

        $data = Category::activos()->where('parent_id',0)->orderBy('position')->get();

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

    public function occasions()
    {
        $special_occasion       = Category::where('special_occasion',true)->first();
        $response_sub_cate = [];
        if($special_occasion){
            $subCategories          = Category::where('parent_id', $special_occasion->id)
                ->orderby('position', 'asc')
                ->activos()
                ->orderBy('position')
                ->get();

            foreach ($subCategories as $subcategory) {
                $row_sub_cate = new \stdClass();
                $row_sub_cate->id = $subcategory->id;
                $row_sub_cate->title = $subcategory->name ? trim($subcategory->name): '';
                $row_sub_cate->poster = !empty($subcategory->poster) ? asset('images/categories/' .$subcategory->poster) : '';
                $row_sub_cate->link = '/'.trim($special_occasion->slug).'/'.trim($subcategory->slug);
                $response_sub_cate[] = $row_sub_cate;
            }
        }


        return $response_sub_cate;
    }

    public function products()
    {
        $response_products = [];
        $products = [];
        $products = Producto::whereHas('categoria',function ($q) {
            $q->activos();
        })->activos()
            ->orderBy('id','DESC')
            ->limit(10)
            ->get();

        if(count($products)>0){
            foreach ($products as $product) {

                $image_galeria_inicial = $product->galleries()->orderBy('order', 'asc')->first() ;

                $image_product=$image_galeria_inicial? $image_galeria_inicial->image : null;
                $row                        = new \stdClass();
                $row->id                    = $product->id;
                $row->title                 = $product->title_large ? trim($product->title_large): '';
                $row->categoria_id          = $product->categoria_id;
                $row->categoria_slug        = $product->categoria ? $product->categoria->slug : '';
                $row->categoria             = $product->categoria ? $product->categoria->name : '';
                $row->codigo                = $product->code ? trim($product->code): '';
                $row->slug                  = $product->slug ? trim($product->slug): '';
                $row->image                 = $image_product ? asset('images/products/' .$product->id.'/'.$image_product) : '';
                $row->image_cover           = !empty($product->image_cover) ? asset('images/products/'.$product->id.'/' . $product->image_cover) : '';
                $row->link                  = 'producto/'.trim($product->slug);
                $response_products[]= $row;
            }
        }


        return $response_products;

    }

    public function loadProductsOccasions($subcategory = null)
    {
        $data                               = new \stdClass();
        $data->product_special_occasion     = count($this->productsOccasions($subcategory)) > 0 ? $this->productsOccasions($subcategory) : [];

        $status = 1;
        $code   = 200;
        $data   = $data;

        return $this->apiResponse($status,$code,$data);
    }


    public function subscriptionStore(SubscriptionRequest $request)
    {
        DB::beginTransaction();
        try{
            Subscription::create(['email' => $request->email]);
            DB::commit();
        } catch(Exception $exc){
            DB::rollBack();
            $status = 0;
            $code   = 500;
            $data   = $exc;
            return $this->apiResponse($status,$code,$data);
        }

        $row                = new \stdClass();
        $row->msg           = 'suscripción realizada correctamente';

        $status = 1;
        $code   = 201;
        $data   = $row;

        return $this->apiResponse($status,$code,$data);
    }

    public function getFiltros(Request $request){

        $data                               = new \stdClass();
        if($this->getColoresFiltro()>0){
            $data->colores                               = $this->getColoresFiltro();
        }


        if(count($this->getTiposByMaster(TypeChapas::master()))>0){
            $data->tipo_cerraduras                       = $this->getTiposByMaster(TypeChapas::master());
        }

        if(count($this->getTiposByMaster(TypeCantidadPuertas::master()))>0){
            $data->tipo_cantidad_puertas                 = $this->getTiposByMaster(TypeCantidadPuertas::master());
        }

        if(count($this->getTiposByMaster(TypeCantidadCuerpos::master()))>0){
            $data->tipo_cantidad_cuerpos                 = $this->getTiposByMaster(TypeCantidadCuerpos::master());
        }

        if(count($this->getTiposByMaster(TypeCantidadBandejas::master()))>0){
            $data->tipo_cantidad_bandejas                 = $this->getTiposByMaster(TypeCantidadBandejas::master());
        }

        if(count($this->getTiposByMaster(TypeCantidadCajones::master()))>0){
            $data->tipo_cantidad_cajones                 = $this->getTiposByMaster(TypeCantidadCajones::master());
        }

        if(count($this->getTiposByMaster(TypeMaterial::master()))>0){
            $data->tipo_material                         = $this->getTiposByMaster(TypeMaterial::master());
        }





        $status = 1;
        $code   = 200;
        $data   = $data;

        return $this->apiResponse($status,$code,$data);
    }

    public function hasProductByTipo(){

    }

    public function getTiposByMaster($master){
        $tipos = Tipos::byMasterId($master)->get();
        $response = [];
        foreach ($tipos as $tipo) {
            $row = new \stdClass();
            $productos = Producto::where('tipo_cerradura',$tipo->id)
                                    ->orWhere('tipo_cantidad_puertas_id',$tipo->id)
                                    ->orWhere('tipo_cantidad_cuerpos_id',$tipo->id)
                                    ->orWhere('tipo_cantidad_cajones_id',$tipo->id)
                                    ->orWhere('tipo_material_id',$tipo->id)
                                    ->orWhere('tipo_cantidad_bandejas_id',$tipo->id)->count();
            if($productos>0){
                $row->id           = $tipo->id;
                $row->name         = $tipo->name;
                $row->count_product = $productos;
                $response[]        = $row;
            }


        }

        return $response;

    }




    public function getColoresFiltro(){
        $response = [];
        $colores = Colores::all();

        if ($colores && count($colores) > 0) {
            foreach ($colores as $color) {
                $row = new \stdClass();
                $producto_ids = ProductoColor::where('color_id',$color->id)->pluck('producto_id')->toArray();
                $productos = Producto::whereIn('id',$producto_ids)->count();
                if($productos>0){
                    $row->id           = $color->id;
                    $row->name         = $color->nombre ? trim($color->nombre): '';
                    $row->valor         = $color->valor;
                    $row->count_product = $productos;
                    $response[]        = $row;
                }

            }
        }
        return $response;
    }
}
