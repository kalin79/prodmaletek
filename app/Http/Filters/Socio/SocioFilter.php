<?php


namespace App\Http\Filters\Socio;

use App\Http\Filters\Filter;
use App\Models\Socios;

class SocioFilter extends Filter
{

    protected $filters = ['byField', 'filter', 'field', 'operator', 'value','byDocument'];

    protected function byField($value, $operator, $field)
    {
        $value = operator_format_like_string($value, $operator);

        return $this->builder->where($field, operator($operator), $value);
    }

    protected function byDocument($value){
        $socio = Socios::where('estado',1)->get()->where('nro_documento', $value)->first();
        if($socio){
            return $this->builder->where('id',$socio->id);
        }

        
        
    }
}
