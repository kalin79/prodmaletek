<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ofertas extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryFilter;
    protected $table = 'ofertas';
    protected $fillable = ['marca_id', 'oferta','terminos_condiciones','active'];

}
