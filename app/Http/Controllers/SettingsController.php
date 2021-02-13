<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Address;
use App\RoleUser;
use App\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function settingsUser()
    {
        // get user/address/role auth
        $user =  Settings::authUser(Auth::user()->id);
        $address = Address::userAddress(Auth::user()->id);

        return ['user' => $user, 'address' => $address];

    }

    // ---== MODIFY INFORMATION ==---
    public function updateInformation(Request $request)
    {
        Validator::make($request->all(), [
            'name'         => ['required', 'string', 'max:255'],
            'password'     => ['nullable', 'string', 'min:8'],
            'street'       => ['nullable', 'string', 'max:55'],
            'number'       => ['nullable', 'numeric', 'min:1'],
            'city'         => ['nullable', 'string', 'max:55'],
            'state'        => ['nullable', 'string', 'max:55'],
            'country'      => ['nullable', 'string', 'max:55'],
        ])->validate();



        // // modify user
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

        return ['user' => $user, 'address' => $address];

    }

}
