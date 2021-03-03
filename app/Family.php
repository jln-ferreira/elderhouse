<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $guarded = [];


    public static function activeClient($clientId)
    {
        return Family::where([['active', 1],['client_id', $clientId]])->get();
    }

}
