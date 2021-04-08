<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    public static function allMenuRole()
    {
        $menuRoles = DB::table('menu_roles')
                    ->select('menu_roles.id AS menu_role_id', 'menu_roles.role_id AS role_id', 'roles.name AS role_name', 'menu_roles.menu_id AS menu_id', 'menus.name AS menu_name')
                    ->leftJoin('roles', 'menu_roles.role_id', '=', 'roles.id')
                    ->leftJoin('menus', 'menu_roles.menu_id', '=', 'menus.id')
                    ->where([
                        ["menus.active", "=", 1],
                        ["roles.active", "=", 1],
                        ["menu_roles.active", "=", 1]
                    ])
                    ->get();


        // design new array
        $result = [];
        foreach ($menuRoles as $menuRole)
        {
            $result[$menuRole->role_id]['role_id'] = $menuRole->role_id;
            $result[$menuRole->role_id]['role_name'] = $menuRole->role_name;
            $result[$menuRole->role_id]['menus'][] = array('menu_role_id' => $menuRole->menu_role_id, 'menu_id' => $menuRole->menu_id, 'menu_name' => $menuRole->menu_name);
        }

        // to array
        $resultArray = [];
        foreach ($result as $value) {
            array_push($resultArray, $value);
        };

        return $resultArray;
    }


    public static function getMenuRole($roleId)
    {
        $menuRoles = DB::table('menu_roles')
                    ->select('menu_roles.id AS menu_role_id', 'menu_roles.role_id AS role_id', 'roles.name AS role_name', 'menu_roles.menu_id AS menu_id', 'menus.name AS menu_name')
                    ->leftJoin('roles', 'menu_roles.role_id', '=', 'roles.id')
                    ->leftJoin('menus', 'menu_roles.menu_id', '=', 'menus.id')
                    ->where([
                        ["menus.active", "=", 1],
                        ["roles.active", "=", 1],
                        ["menu_roles.active", "=", 1],
                        ["roles.id", "=", $roleId],
                    ])
                    ->get();


        // design new array
        $result = [];
        foreach ($menuRoles as $menuRole)
        {
            $result[$menuRole->role_id]['role_id'] = $menuRole->role_id;
            $result[$menuRole->role_id]['role_name'] = $menuRole->role_name;
            $result[$menuRole->role_id]['menus'][] = array('menu_role_id' => $menuRole->menu_role_id, 'menu_id' => $menuRole->menu_id, 'menu_name' => $menuRole->menu_name);
        }

        // to array
        $resultArray = [];
        foreach ($result as $value) {
            array_push($resultArray, $value);
        };

        return $resultArray;
    }
}
