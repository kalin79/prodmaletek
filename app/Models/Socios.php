<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Socios extends Model
{
    use HasFactory;
    //use SoftDeletes;
    use QueryFilter;
    protected $table = 'socios';
    protected $fillable = ['dni', 'nombre','vocativo','estado','campana','tipo_tarjeta','cumpleanos','ingreso','fecha_ingreso'];



    public function getNroDocumentoAttribute(){
        return Crypt::decrypt($this->dni);
    }

   
    public function intentosOtp(){
        return $this->hasMany(HistorialOtp::class,'id_cliente');
    }

    public function getFechaIngresoFormatAttribute(){
        return  date("d/m/Y",strtotime($this->fecha_ingreso));
    }
    
}
