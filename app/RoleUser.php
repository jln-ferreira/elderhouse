<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RoleUser extends Model
{
    protected $guarded = [];

    // display menu for expecific user on the SIDE BAR
    public static function getMenu(){
        return DB::table('users')
                ->select('menus.*')
                ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
                ->leftJoin('menu_roles', 'role_users.role_id', '=', 'menu_roles.role_id')
                ->leftJoin('menus', 'menu_roles.menu_id', '=', 'menus.id')
                ->where([
                    ["menus.active", "=", 1],
                    ["role_users.active", "=", 1],
                    ["menu_roles.active", "=", 1]
                ]);
    }


    // Get user auth role
    public static function getUserRole($user_id)
    {
        return RoleUser::where([['active', 1],['user_id', $user_id]])->get();
    }

}
