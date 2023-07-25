<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;

abstract class Filter
{
    /**
     * @var Request
     */
    protected $request;
    
    /**
     * The Eloquent builder.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;
    
    /**
     * Registered filters to operate upon.
     *
     * @var array
     */
    protected $filters = [];
    /**
     * Create a new ThreadFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Apply the filters.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply($builder)
    {
        $this->builder = $builder;
        $filters = $this->getFilters();
        
        foreach ($filters as $filter => $value) {
                        
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        
        return $this->builder;
    }
    
    public function dynamic($builder)
    {
        $this->builder = $builder;
        $filters = $this->getFilters();

        if ($this->hasFilter('filter')) {
            foreach ($filters['filter'] as $indx => $method) {
                $operator = $filters['operator'][$indx];
                $value = $filters['value'][$indx];
                $field = $filters['field'][$indx] ?? null;
                
                if (method_exists($this, $method)) {
                    $this->$method($value, $operator, $field);
                }
            }
        }
        
        return $this->builder;
    }

    /**
     * Fetch all relevant filters from the request.
     *
     * @return array
     */
    
    public function getFilters()
    {
        $filters = $this->request->filters ? : [];
        
        /**
         * Se agrego el condicional para el caso de envios de filtros para exportar a excel y pdf
         *          
         */
        if(request()->get('filters_aditional')){
            $value_filters = request()->get('filters_aditional') ? : '[]';
            $filters_array = json_decode($value_filters, true);
            $filters = isset($filters_array['filters']) ? $filters_array['filters'] : [];
        }
        /**
         * Se agrego el condicional para el caso de envios de filtros para exportar a excel y pdf
         *          
         */
        return array_filter($filters);
    }
    
    public function hasFilter($filter)
    {
        return isset($this->getFilters()[$filter]) ? true : false;
    }
    
}