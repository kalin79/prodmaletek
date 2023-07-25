<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RelationProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryFilter;
    protected $table = 'relation_products';
    protected $fillable = ['product_id','product_relation_id','active','created_user_id','updated_user_id','deleted_user_id'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'product_relation_id' => 'integer',

    ];

    //var $category = null;

    public static function storeValidation($request)
    {
        return [


        ];
    }

    public static function updateValidation($request)
    {
        return [


        ];
    }

    public static function attributesValidation()
    {
        return [

        ];
    }

    public function scopeActivos($query)
    {
        return $query->where('active', 1);
    }

    public function producto(){
        return $this->belongsTo(Producto::class,'product_relation_id');
    }
}
