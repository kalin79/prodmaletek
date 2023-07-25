<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use QueryFilter;
    protected $table = 'modules';


    public function page(){
    	return $this->hasMany(Page::class,'module_id');
    }
}
