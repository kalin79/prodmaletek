<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;

use App\Models\Marcas;
use App\Models\Producto;
use App\Models\ProductoColorImage;
use App\Models\ProductoLike;
use App\Traits\ApiResponser;

use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\DB;

class MarcaController  extends Controller
{
    use ApiResponser;

    public function index($slug)
    {
        $marca = Marcas::where('slug', '=', $slug)->firstOrFail();

        $data                               = new \stdClass();
        $data->product                      = $this->marca($marca, false, true);
        $status = 1;
        $code   = 200;
        $data   = $data;

        return $this->apiResponse($status, $code, $data);
    }

    public function marca(Marcas $marca, $with_category = false, $with_gallery = false)
    {
        $row                = new \stdClass();
        $row->id            = $marca->id;
        $row->nombre          = $marca->nombre;
        $row->descripcion         = $marca->descripcion;
        $row->descripcion_historia_1         = $marca->descripcion_historia_1 ;
        $row->descripcion_historia_2         = $marca->descripcion_historia_2;
        $row->origen_pais     = $marca->origen_pais;
        $row->anios_en_mercado_mundial         = $marca->anios_en_mercado_mundial ? trim($marca->anios_en_mercado_mundial) : '';
        $row->anios_en_mercado_peru               = $marca->anios_en_mercado_peru ? trim($marca->anios_en_mercado_peru) : '';
        $row->tallares_oficiales               = $marca->tallares_oficiales ? trim($marca->tallares_oficiales) : '';
        $row->logo_detalle         = !empty($marca->logo_detalle) ? asset('images/marcas/' . $marca->id . '/' . $marca->logo_detalle) : '';
        $row->image_detalle   = !empty($marca->image_detalle) ? asset('images/marcas/' . $marca->id . '/' . $marca->image_detalle) : '';
        $row->origen_pais_logo   = !empty($marca->origen_pais_logo) ? asset('images/marcas/' . $marca->id . '/' . $marca->origen_pais_logo) : '';
        $row->productos_mas_vistos         = $this->productosMasVistos($marca);
        $row->gallery_products       = $this->productosByMarca($marca);
        return $row;
    }

    /*public function galleryProduct(Marcas $marca)
    {
       
        $productos_ids= Producto::activos()->where('marca_id',$marca->id)->get()->pluck('id')->toArray();
        $gallery = ProductoColorImage::where('is_default',1)->with('productoColor')->whereHas('productoColor',function($query)use($productos_ids){
            $query->whereIn('producto_id',$productos_ids);
        });
        $response_gallery = [];
        foreach ($gallery as $image) {
            $response_gallery[]   = !empty($product->poster) ? asset('images/products/' . $product->id . '/' . $image->image) : '';;
        }
        return $response_gallery;
    }*/

    public function productosMasVistos(Marcas $marca){
        $response = [];
        $data = Producto::activos()->where('es_mas_visto',1)->where('marca_id',$marca->id)->orderBy('titulo')->get();
        if ($data && count($data) > 0) {
            foreach ($data as $producto) {
                $image_default = ProductoColorImage::where('is_default',1)->with('productoColor')->whereHas('productoColor',function($query)use($producto){
                    $query->where('producto_id',$producto->id);
                })->first();
                $count_product_like = ProductoLike::where('producto_id',$producto->id)->where('ip',request()->ip())->count();
                $row = new \stdClass();
                $row->id = $producto->id;
                $row->title = $producto->titulo ? trim($producto->titulo): '';
                $row->image         = !empty($image_default->imagen) ? asset('images/products/'.$producto->id.'/'.$image_default->productoColor->color->nombre.'/' . $image_default->imagen) : '';
                $row->precio        = $producto->precio;
                $row->marca         = $producto->marca ? $producto->marca->nombre : '';
                $row->slug         = trim($producto->slug);
                $row->has_like      = $count_product_like>0 ? true:false;
                $row->count_like    = $count_product_like;
                $response[] = $row;
            }
        }

        return $response;
    }

    public function productosByMarca(Marcas $marca){
        $response = [];
        $data = Producto::activos()->where('marca_id',$marca->id)->orderBy('precio','asc')->get();
        if ($data && count($data) > 0) {
            foreach ($data as $producto) {
                $image_default = ProductoColorImage::where('is_default',1)->with('productoColor')->whereHas('productoColor',function($query)use($producto){
                    $query->where('producto_id',$producto->id);
                })->first();
                $count_product_like = ProductoLike::where('producto_id',$producto->id)->where('ip',request()->ip())->count();
                $row = new \stdClass();
                $row->id = $producto->id;
                $row->title = $producto->titulo ? trim($producto->titulo): '';
                $row->image         = !empty($image_default->imagen) ? asset('images/products/'.$producto->id.'/'.$image_default->productoColor->color->nombre.'/' . $image_default->imagen) : '';
                $row->precio        = $producto->precio;
                $row->cilindrada    = $producto->cilindrada;
                $row->marca         = $producto->marca ? $producto->marca->nombre : '';
                $row->slug         = trim($producto->slug);
                $row->colores       = $this->productoColores($producto);
                $row->has_like      = $count_product_like>0 ? true:false;
                $row->count_like    = $count_product_like;
                $response[] = $row;
            }
        }

        return $response;
    }
    public function productoColores(Producto $product)
    {
        $colores = $product->colores;
        $response = [];
        foreach ($colores as $colors) {
            $producto_color_image = ProductoColorImage::where('producto_color_id',$colors->id)->first();
            
            $row = new \stdClass();
            $row->id = $colors->id;
            $row->color = $colors->color->nombre;
            $row->default = $producto_color_image->is_default;
            $row->color_estilo = $colors->color->valor;
            $row->image         = !empty($producto_color_image->imagen) ? asset('images/products/'.$product->id.'/'.$producto_color_image->productoColor->color->nombre.'/' . $producto_color_image->imagen) : '';
            $response[] = $row;
        }
        return $response;
    }

    


}
