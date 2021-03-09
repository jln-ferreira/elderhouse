<?php

namespace App\Http\Controllers;

use App\MenuRole;
use App\Role;
use App\Settings;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MenuRoleController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'roleName' => ['required', 'string', 'max:50', 'min:3' ],
            'menu'     => ['required', 'array', 'min:1'],
        ])->validate();

        //save new ROLE
        $role = Role::create([
            'name' => $request['roleName'],
        ]);

        // save Menu_role
        foreach ($request['menu'] as $menu) {
            MenuRole::create([
                'menu_id'  => $menu,
                'role_id'  => $role->id
            ]);
        }

        return Settings::getMenuRole($role->id);
        // return $role;

    }


    public function show(MenuRole $menuRole)
    {
        //
    }


    public function edit(MenuRole $menuRole)
    {
        //
    }


    public function update(Request $request, MenuRole $menuRole)
    {
        //
    }


    public function destroy(MenuRole $menuRole)
    {
        //
    }
}
