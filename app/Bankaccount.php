<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankaccount extends Model
{
    protected $guarded = [];


    public static function activeClient($clientId)
    {
        return Bankaccount::where([['active', 1],['client_id', $clientId]])->get()->first();
    }
}
