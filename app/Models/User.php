<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Filters\QueryFilter;
class User extends Authenticatable
{
    use SoftDeletes;
    use HasFactory, Notifiable;
    use QueryFilter;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function storeValidation($request)
    {
        return [
            'nombre' => 'max:191|required',
            'email' => 'email|max:191|required',
            'password' => 'required',
            'role' => 'array|required',
            'role.*' => 'integer|exists:roles,id|max:4294967295|required',
            'remember_token' => 'max:191|nullable',
            //'avatar' => 'required|image|mimes:jpeg,png,jpg|max:200',//2M
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'nombre' => 'max:191|required',
            'email' => 'email|max:191|required',
            'password' => '',
            'role' => 'array|required',
            'role.*' => 'integer|exists:roles,id|max:4294967295|required',
            'remember_token' => 'max:191|nullable',
            //'avatar' => 'image|mimes:jpeg,png,jpg|max:200',//2M
        ];
    }

    public static function attributesValidation()
    {
        return [
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'role' => 'Rol',
            'avatar' => 'Avatar',//2M
        ];
    }


    public function role(){
        return $this->belongsToMany(Role::class, 'role_user')->withTrashed();
    }
    public static function getByRole($role)
    {
        $user = User::select('id', 'name')->where('active', true)->orderBy('name')->whereHas('role', function ($query) use ($role) {
            return $query->where('role_user.role_id', $role);
        });
        return $user->get();
    }

    public function isRole($roleId)
    {
        return ($this->role()->where('id', $roleId)->count() > 0) ? true : false;
    }

    public function getRoleId()
    {
        return $this->role()->first()->id;
    }

    public function havePermission($permission){
        
        foreach ($this->role as $roles){
            if($roles->has("permission")){
                foreach ($roles->permission as $permission){
                    if($permission->name ==$permission ){
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
