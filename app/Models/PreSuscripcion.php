<?php

namespace App\Models;

use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreSuscripcion extends Model
{
    use HasFactory;
    // use SoftDeletes;
    // use Audit;

    protected $table = 'pre_suscripcion';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['created_at', 'updated_at','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'nombre_apellidos',
       'celular',
       'correo',
       'departamento_id',
       'provincia_id',
       'distrito_id',
       'tyc'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'active'=> 'integer'
    ];

    public static function storeValidation($request)
    {
        return [
            'email' => 'required|email',
        ];
    }

    public static function attributesValidation()
    {
        return [
            'email' => 'email',
        ];
    }
}
