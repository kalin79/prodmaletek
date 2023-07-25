<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductoColorImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'producto_color_images';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'producto_color_id', 'imagen','is_default','active'
    ];

    public function getColorAttribute(){
        $producto_color = ProductoColor::find($this->producto_color_id);
        return $producto_color ? ( $producto_color->color ? $producto_color->color->nombre : '') : '';
    }

    public function updateImages($images)
    {
        $array_extension = ['jpeg','png','jpg'];
        if ($images) {

            if(in_array($images->getClientOriginalExtension(),$array_extension)){
                /*$fileName = $this->id . "-" . time() . '.' . $images->getClientOriginalExtension();
                $producto_color = ProductoColor::find($this->producto_color_id);
                //dd($producto_color);
                $path = Storage::disk('products')->putFileAs($producto_color->producto_id."/".$producto_color->color->nombre, $images, $fileName);
                $this->fill([
                    'imagen' => basename($path)
                ])->save();*/
                $producto_color = ProductoColor::find($this->producto_color_id);
                $destinationPath = public_path('/images/products/'.$producto_color->producto_id.'/'.$producto_color->color->nombre);

                if(!File::isDirectory($destinationPath)){

                    File::makeDirectory($destinationPath, 0777, true, true);
                }

                $file = $images;
                //$imagename = time() . "-sl." . $file->getClientOriginalExtension();
                //$imagename = $this->id . "-desk-" . time() . '.' . $image->getClientOriginalExtension();
                $imagename = $this->id . "-" . time() . '.' . $images->getClientOriginalExtension();
                $file->move($destinationPath, $imagename);
                $this->update(['imagen'=>$imagename]);
            }

        }
    }

    public function productoColor(){
        return $this->belongsTo(ProductoColor::class,'producto_color_id');
    }

}
