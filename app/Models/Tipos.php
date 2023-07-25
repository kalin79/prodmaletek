<?php

namespace App\Models;

use App\Traits\Audit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tipos extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Audit;
    
    protected $fillable = ['id', 'mtype_id', 'name', 'parent_id','created_user_id','updated_user_id','deleted_user_id'];
    
    public function scopeByMasterId($query, $id)
    {
        return $query->where('mtype_id', $id);
    }
    
    public function parentType()
    {
        return $this->hasOne($this, 'id', 'parent_id');
    }

    public function scopeById($query, $ids)
    {
        if (is_array($ids)) {
            return $query->whereIn('id', $ids);    
        }
        
        return $query->where('id', $ids);
    }
}
