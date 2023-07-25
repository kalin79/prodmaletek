<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

use App\Models\Page;
use User;

class Access extends Model
{
    protected $table = 'access';
    protected $fillable = ['role_id', 'page_id', 'status'];

    public function page(){
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function menu()
    {
        $user = Auth::user();
        //dd($user);
        return $this->join('pages', 'pages.id', '=', 'access.page_id')
            ->join('modules', 'modules.id', '=', 'pages.module_id')
            ->where('access.status', 1)
            ->where('access.role_id', $user->role_id)
            ->where('pages.status', 1)
            ->where('modules.status', 1)
            ->select(
                'access.id',
                'access.page_id',
                'pages.name AS page_name',
                'pages.module_id',
                'modules.name AS module_name',
                'modules.icon AS icon',
                'pages.url')
            ->orderBy('modules.name', 'asc')
            ->orderBy('pages.orden', 'asc')
            ->get()
            ->toArray();
    }

    public static function sideBar()
    {
        $access = new Access();
        $data = $access->menu();
        //dd($data);
        $menu = [];
        
        foreach ($data as $row) {
            
            $class_active = '';
            /*
            if(request()->path()==$row['url']){
                $class_active = 'active';
            }*/

            $key = array_search($row['module_id'], array_column($menu, 'id'));
            if ($key >= 0 and !is_bool($key)) {

                $menu[$key]['pages'][] = [
                    'id' => $row['page_id'],
                    'name' => $row['page_name'],
                    'url' => $row['url'],
                    'icon' =>$row['icon'],
                    'active' => $class_active
                ];
            } else {
                $pages = [];
                $pages[0] = [
                    'id' => $row['page_id'],
                    'name' => $row['page_name'],
                    'url' => $row['url'],
                    'icon' =>$row['icon'],
                    'active' => $class_active
                ];
                $menu[] = [
                    'id' => $row['module_id'],
                    'name' => $row['module_name'],
                    'icon' =>$row['icon'],
                    'pages' => $pages,
                    'active' =>$class_active
                ];
            }
        }
        return $menu;
    }

    public static function permits($page){
        $user_id = Auth::user()->id;
        $user = User::findOrFail( $user_id );

        if($user){
            $role = $user->role_id;

            $permits = Access::where('role_id', $role)
                ->where('page_id', $page)
                ->where('status', 1)
                ->count();

            if( $permits > 0 ){
                return true;
            }
        }

        return false;
    }
}
