<?php
namespace App\Http\Filters;

use App\Http\Filters\Filter;

trait QueryFilter {
    
    public function scopeFilter($query, Filter $filter)
    {
        return $filter->apply($query);
    }
    
    public function scopeFilterDynamic($query, Filter $filter)
    {
        return $filter->dynamic($query);
    }
    
}