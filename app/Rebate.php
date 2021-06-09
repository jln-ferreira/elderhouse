<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Rebate extends Model
{
    protected $guarded = [];

    // GET THE REBATE
    public static function getRebate($id)
    {
        return DB::table('rebates')
        ->select(
            'rebates.id AS rebate_id',
            'rebates.user_id AS user_id',
            'rebates.client_products_id AS client_product_id',
            'rebates.product_id AS product_id',
            'rebates.date AS date',
            'rebates.comment AS comment'
        )
        ->where([['rebates.id', $id], ['rebates.active', 1]])
        ->get();
    }
}
