<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class HistorialOtp extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryFilter;
    protected $table = 'historial_otp';
    protected $fillable = ['id_cliente', 'codigo','tipo'];
}
