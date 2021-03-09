<?php

namespace App\Http\Controllers;

use App\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{


    public function menuRole()
    {
        return Settings::allMenuRole();
    }


}
