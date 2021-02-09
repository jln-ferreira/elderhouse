<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $guarded = [];


    // ------- RELATIONSHIP -------
    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
