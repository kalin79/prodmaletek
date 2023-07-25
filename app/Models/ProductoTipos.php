<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoTipos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'producto_tipos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'producto_id', 'tipo_moto_id'
    ];


    public function tipos(){
        return $this->hasOne(Tipos::class,'id','tipo_moto_id');
    }
    

   
}
