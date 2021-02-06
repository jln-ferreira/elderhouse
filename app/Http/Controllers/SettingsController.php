<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Address;
use App\RoleUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function settingsUser()
    {
        // get user/address/role auth
        $user =  Settings::authUser(Auth::user()->id);
        $address = Address::userAddress(Auth::user()->id);
        $roles = RoleUser::getUserRole(Auth::user()->id);

        return ['user' => $user, 'address' => $address, 'roles' => $roles];

    }

}
