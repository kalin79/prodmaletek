<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $table = 'districts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','province_id','department_id','description','active',
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
        'province_id' => 'integer',
        'department_id' => 'integer',
        'description' => 'string',
        'active' => 'boolean',

    ];

    public static function storeValidation($request)
    {
        return [
            'province_id' => 'numeric|required',
            'department_id' => 'numeric|required',
            'description' => 'required',

        ];
    }

    public static function updateValidation($request)
    {
        return [
            'province_id' => 'numeric|required',
            'department_id' => 'numeric|required',
            'description' => 'required',

        ];
    }

    public static function attributesValidation(){
        return [
            'province_id' => 'province_id',
            'department_id' => 'department_id',
            'description' => 'description',

        ];
    }

    /*
     * RELATIONS
     * */

    public function province(){
        return $this->belongsTo(Province::class,'province_id')->withTrashed();
    }
}
