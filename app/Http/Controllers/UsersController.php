<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use App\RoleUser;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index() {
        return User::where('active', 1)->get();
    }

    public function create(Request $request)
    {

         Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8'],
            'street'       => ['nullable', 'string', 'max:55'],
            'number'       => ['nullable', 'numeric', 'min:1'],
            'city'         => ['nullable', 'string', 'max:55'],
            'state'        => ['nullable', 'string', 'max:55'],
            'country'      => ['nullable', 'string', 'max:55'],
            'checkedRoles' => ['required'],
        ])->validate();

        //save new user
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        // save new address with user id
        Address::create([
            'user_id'  => $user->id,
            'street'   => $request['street'],
            'number'   => $request['number'],
            'city'     => $request['city'],
            'state'    => $request['state'],
            'country'  => $request['country'],
        ]);

        // save new role_user with user id
        foreach ($request['checkedRoles'] as $role) {
            RoleUser::create([
                'user_id'  => $user->id,
                'role_id'  => $role
            ]);
        }


        return $user;

    }
}
