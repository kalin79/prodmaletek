<?php

namespace App\Models;


use App\Http\Filters\QueryFilter;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use SoftDeletes;
    use QueryFilter;
    protected $fillable = ['name', 'active'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user')->withTrashed();
    }

    public function access(){
        return $this->hasMany('App\Access', 'role_id', 'id');
    }
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
