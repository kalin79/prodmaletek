<?php


namespace App\Http\Filters\Marca;

use App\Http\Filters\Filter;

class MarcaFilter extends Filter
{

    protected $filters = ['byField', 'filter', 'field', 'operator', 'value'];

    protected function byField($value, $operator, $field)
    {
        $value = operator_format_like_string($value, $operator);

        return $this->builder->where($field, operator($operator), $value);
    }

}
