<?php

namespace App;

use DB;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];


    // GET ADDRESS with especific USER
    public static function userAddress($user_id)
    {
        return Address::where([['active', 1],['user_id', $user_id]])->get()->first();
    }
}
