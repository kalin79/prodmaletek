<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryFilter;
    protected $table = 'products';
    protected $fillable = [
        'slug',
        'code',
        'categoria_id',
        'rubro_id',
        'title_small',
        'title_large',
        'precio_normal',
        'precio_online',
        'stcok',
        'description',
        'ficha_tecnica',
        'conditions',
        'poster',
        'image_cover',
        'alto',
        'ancho',
        'fondo',
        'tipo_cantidad_puertas_id',
        'alto_puerta',
        'ancho_puerta',
        'tipo_material_id',
        'pintura',
        'puerta_reforsada',
        'tipo_cerradura',
        'tipo_cantidad_cuerpos_id',
        'tipo_cantidad_cajones_id',
        'tipo_cantidad_bandejas_id',
        'active',
        'bisagras',
        'accesorios',
        'ventilacion',
        'garantia',
        'image_cover',
        'tipo_chapa_id',
        'created_user_id',
        'updated_user_id',
        'deleted_user_id'
    ];


    public function scopeActivos($query)
    {
        return $query->where('active', 1);
    }

    public function updateImages($images, $orders)
    {
        $filePoster = '';
        ProductImage::where('product_id', $this->id)->delete();
        $gallery = [];
        $imageUploads = [];

        if ($images) {
            foreach ($images as $key => $image) {
                /*$nameOriginal = $image->getClientOriginalName();
                $fileName = $this->id . "-" . time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                Storage::disk('products')->putFileAs($this->id, $image, $fileName);*/
                /*Redimencionando 100 * 100*/
                //$this->resizeImage(Storage::disk('products')->path($path), 100, 100, 'small');
                //$this->resizeImage(Storage::disk('products')->path($path), 300, 300, 'medium');
                /*$imageUploads[] = [
                    'original' => $nameOriginal,
                    'upload' => $fileName
                ];*/

                $destinationPath = public_path('/images/products/'.$this->id);
                if(!File::isDirectory($destinationPath)){
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $file = $image;
                //$imagename = time() . "-sl." . $file->getClientOriginalExtension();
                $imagename = $this->id . "-desk-" . time() . '.' . $image->getClientOriginalExtension();
                $file->move($destinationPath, $imagename);
                $this->update(['poster'=>$imagename]);

            }
        }

    }

    public function storeGallery($images)
    {
        if ($images) {
            foreach ($images as $key => $image) {
                $destinationPath = public_path('/images/products/'.$this->id);
                if(!File::isDirectory($destinationPath)){
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $file = $image;
                //$imagename = time() . "-sl." . $file->getClientOriginalExtension();
                $imagename = $this->id . "-desk-" . time() . '.' . $image->getClientOriginalExtension();
                $file->move($destinationPath, $imagename);
                $this->update(['poster'=>$imagename]);
                ProductImage::create([
                    'product_id' => $this->id,
                    'image' => $imagename,
                    'order' => $key + 1
                ]);
            }
        }
    }

    public function updateGallery($images)
    {
        $last_order = $this->galleries()->orderBy('order', 'desc')->first() ? $this->galleries()->orderBy('order', 'desc')->first()->order : 0;
        if ($images) {
            foreach ($images as $key => $image) {
                $destinationPath = public_path('/images/products/'.$this->id);
                if(!File::isDirectory($destinationPath)){
                    File::makeDirectory($destinationPath, 0777, true, true);
                }
                $file = $image;
                //$imagename = time() . "-sl." . $file->getClientOriginalExtension();
                $imagename = $this->id . "-" . time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $file->move($destinationPath, $imagename);
                $this->update(['poster'=>$imagename]);
                ProductImage::create([
                    'product_id' => $this->id,
                    'image' => $imagename,
                    'order' => $last_order + 1
                ]);
                $last_order ++;
            }
        }
    }

    public function updateFichaTecnica($pdf)
    {
        if ($pdf) {
            $destinationPath = public_path('/images/products/'.$this->id.'/documentos');
            if(!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $file = $pdf;
            //$imagename = time() . "-sl." . $file->getClientOriginalExtension();
            $imagename = $this->id . "-" . time() . '-ficha_tenica.' . $pdf->getClientOriginalExtension();
            $file->move($destinationPath, $imagename);
            $this->update(['ficha_tecnica'=>$imagename]);
        }
    }

    public function updateImageCover($image)
    {
        if ($image) {
            $destinationPath = public_path('/images/products/'.$this->id);
            if(!File::isDirectory($destinationPath)){
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $file = $image;
            //$imagename = time() . "-sl." . $file->getClientOriginalExtension();
            $imagename = $this->id . "-" . time() . '-cover.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $imagename);
            $this->update(['image_cover'=>$imagename]);
        }
    }

    public function getPathImageDefaultAttribute(){
        $image_default = ProductoColorImage::where('is_default',1)->with('productoColor')->whereHas('productoColor',function($query){
            $query->where('producto_id',$this->id);
        })->first();
        $path_image_color_default= !empty($image_default->imagen) ? asset('images/products/'.$this->id.'/'.$image_default->productoColor->color->nombre.'/' . $image_default->imagen) :null;
        if(!$path_image_color_default){
            $image_galeria_inicial = $this->galleries()->orderBy('order', 'asc')->first() ;
            $image_product=$image_galeria_inicial? $image_galeria_inicial->image : null;
            $path_image_color_default = $image_product ? asset('images/products/' .$this->id.'/'.$image_product) : '';
        }



        return $path_image_color_default;
    }

    public function loadGallery()
    {
        return $this->galleries()->orderBy('order', 'asc')->get();
    }
    public function galleries()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function colores()
    {
        return $this->hasMany(ProductoColor::class, 'producto_id');
    }

    public function tiposMoto()
    {
        return $this->hasMany(ProductoTipos::class, 'producto_id');
    }

    public function categoria(){
        return $this->hasOne(Category::class,'id','categoria_id');
    }

    public function tipoCantidadPuerta(){
        return $this->hasOne(Tipos::class,'id','tipo_cantidad_puertas_id');
    }
    public function tipoCantidadCuerpos(){
        return $this->hasOne(Tipos::class,'id','tipo_cantidad_cuerpos_id');
    }
    public function tipoCantidadCajones(){
        return $this->hasOne(Tipos::class,'id','tipo_cantidad_cajones_id');
    }

    public function tipoCantidadBandejas(){
        return $this->hasOne(Tipos::class,'id','tipo_cantidad_bandejas_id');
    }
    public function tipoCerradura(){
        return $this->hasOne(Tipos::class,'id','tipo_cerradura');
    }

    public function tipoMaterial(){
        return $this->hasOne(Tipos::class,'id','tipo_material_id');
    }

    public function relationProduct()
    {
        return $this->hasMany(RelationProduct::class, 'product_id');
    }

    public function rubro(){
        return $this->hasOne(Rubros::class,'id','rubro_id');
    }


}
