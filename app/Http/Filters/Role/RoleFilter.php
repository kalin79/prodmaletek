<?php

namespace  App\Http\Filters\Role;

use App\Http\Filters\Filter;
class RoleFilter extends Filter
{
    protected $filters = ['byField', 'filter', 'field', 'operator', 'value'];
    
    protected function byField($value, $operator, $field)
    {
        $value = operator_format_like_string($value, $operator);
        
        return $this->builder->where($field, operator($operator), $value);
    }
}