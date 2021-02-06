<?php

namespace App;

use App\users;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    // GET user auth
    public static function authUser($id)
    {
        return User::where([['active', 1], ['id', $id]])->get()->first();
    }

}
