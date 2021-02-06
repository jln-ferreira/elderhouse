<?php

namespace App\Http\Controllers;

use App\User;
use App\Address;
use App\RoleUser;
use DB;


use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{


    public function index()
    {

        return User::where('active', 1)->get();

    }


    // ---== CREATE ==---
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


    // ---== DELETE ==---
    public function destroy($id)
    {

        $user = User::find($id);
        $user->active = 0;
        $user->save();

        return $user;

    }


    // ---== MODIFY ==---
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255'],
            'password'     => ['nullable', 'string', 'min:8'],
            'street'       => ['nullable', 'string', 'max:55'],
            'number'       => ['nullable', 'numeric', 'min:1'],
            'city'         => ['nullable', 'string', 'max:55'],
            'state'        => ['nullable', 'string', 'max:55'],
            'country'      => ['nullable', 'string', 'max:55'],
            'checkedRoles' => ['required'],
        ])->validate();

        // modify user
        $user = User::find($request['id']);
        $user->name = $request['name'];
        is_null(!$request['password']) ? $user->password = Hash::make($request['password']) : "";
        $user->save();

        // modify address
        $address = Address::where([['active', 1],['user_id', $request['id']]])->get()->first();
        $address->street  = $request['street'];
        $address->number  = $request['number'];
        $address->city    = $request['city'];
        $address->state   = $request['state'];
        $address->country = $request['country'];
        $address->save();

        // modify roles
        $roles = RoleUser::where([['active', 1],['user_id', $request['id']]])->update(['active' => 0]);

        foreach ($request['checkedRoles'] as $key => $value) {
            RoleUser::updateOrCreate(
                ['user_id' => $request['id'], 'role_id' => $value],
                ['role_id' => $value, 'active' => 1]
            );
        };

        return $user;

    }


    // ---------======GET INFORMATIONS API======---------
    public function getUserAddressRole($user_id)
    {

        $address = Address::userAddress($user_id);
        $role = RoleUser::getUserRole($user_id);

        return ['address' => $address, 'role' => $role];

    }

}
