<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoColor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'producto_color';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'producto_id', 'color_id'
    ];


    public function color(){
        return $this->hasOne(Colores::class,'id','color_id');
    }
    
    public function producto(){
        return $this->hasOne(Producto::class,'id','producto_id');
    }

   
}
