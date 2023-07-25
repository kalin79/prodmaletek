<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $table = 'provinces';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','department_id','description','active',
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
        'department_id' => 'integer',
        'description' => 'string',
        'active' => 'boolean',

    ];

    public static function storeValidation($request)
    {
        return [
            'department_id' => 'numeric|required',
            'description' => 'required',

        ];
    }

    public static function updateValidation($request)
    {
        return [
            'department_id' => 'numeric|required',
            'description' => 'required',

        ];
    }

    public static function attributesValidation(){
        return [
            'department_id' => 'department_id',
            'description' => 'description',

        ];
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id')->withTrashed();
    }
}