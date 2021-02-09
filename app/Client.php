<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];


    public static function activeclients()
    {
        return DB::table('clients')
        ->leftJoin('specifications', 'clients.id', '=', 'specifications.client_id')
        ->where([['clients.active', 1], ['specifications.active', 1]])->get();
    }


    // ------- RELATIONSHIP -------
    public function specification()
    {
        return $this->hasOne(Specification::class);
    }

}
