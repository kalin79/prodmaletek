<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use QueryFilter;
    protected $table = 'pages';
    protected $fillable = ['name', 'status'];


    public function module(){
    	return $this->belongsTo(Module::class);
    }

    public function access(){
        return $this->hasMany('App\Access', 'page_id', 'id');
    }

    public function scopeSearchModule($query,$buscar){

    	if (!empty(trim($buscar))) {
	        $query->WhereHas('module', function($query) use($buscar)
	        {
	        	$query->where('pages.name', 'like', '%'.$buscar.'%')
	                  ->orWhere('pages.slug', 'like', '%'.$buscar.'%')
	        		  ->orWhere('modules.name','like','%'.$buscar.'%')
	        		  ->where('pages.status','<>',2);

	        });
	    }
    }

    public function scopeSearch( $query, $search ) {
        if ( ! empty( $search ) ) {
            return $query->where( function( $query ) use( $search ) {
                $query->where( 'modules.name', 'like', '%' . $search . '%' )
                    ->orWhere( 'pages.name', 'like', '%' . $search . '%' );
            });
        }
    }
}
