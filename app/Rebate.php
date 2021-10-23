<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Rebate extends Model
{
    protected $guarded = [];

    //Get medicates
    public static function getRebates()
    {
        return DB::table('rebates')
        ->select(
            'rebates.id',
            'clients.name',
            'clients.surname',
            'products.name AS productName',
            'measurements.name AS measurementName',
            'client_products.quantity',
            'client_products.time',
            'rebates.date',
            'rebates.comment AS rebateComment',
            'users.name AS userName',
            'medicates.id AS medicateId',
            'medicates.comment AS medicateComment'
        )
        ->leftJoin('users', 'rebates.user_id', 'users.id')
        ->leftJoin('client_products', 'rebates.client_products_id', 'client_products.id')
        ->leftJoin('products', 'client_products.product_id', 'products.id')
        ->leftJoin('measurements', 'client_products.measurement_id', 'measurements.id')
        ->leftJoin('clients', 'client_products.client_id', 'clients.id')
        ->leftJoin('medicates', 'client_products.id', 'medicates.client_products_id')
        ->where([['rebates.active', 1]])
        ->orderBy('rebates.date')
        ->get();
    }

    // GET THE REBATE
    public static function getRebate($id)
    {
        return DB::table('rebates')
        ->select(
            'rebates.id',
            'clients.name',
            'clients.surname',
            'products.id AS productId',
            'products.name AS productName',
            'measurements.name AS measurementName',
            'client_products.id AS clientProductId',
            'client_products.quantity',
            'client_products.time',
            'rebates.date',
            'rebates.comment AS rebateComment',
            'users.name AS userName',
            'medicates.id AS medicateId',
            'medicates.comment AS medicateComment'
        )
        ->leftJoin('users', 'rebates.user_id', 'users.id')
        ->leftJoin('client_products', 'rebates.client_products_id', 'client_products.id')
        ->leftJoin('products', 'client_products.product_id', 'products.id')
        ->leftJoin('measurements', 'client_products.measurement_id', 'measurements.id')
        ->leftJoin('clients', 'client_products.client_id', 'clients.id')
        ->leftJoin('medicates', 'client_products.id', 'medicates.client_products_id')
        ->where([['rebates.id', $id], ['rebates.active', 1]])
        ->orderBy('rebates.date')
        ->get();

        // return DB::table('rebates')
        // ->select(
        //     'rebates.id AS rebate_id',
        //     'rebates.user_id AS user_id',
        //     'rebates.client_products_id AS client_product_id',
        //     'rebates.product_id AS product_id',
        //     'rebates.date AS date',
        //     'rebates.comment AS comment'
        // )
        // ->where([['rebates.id', $id], ['rebates.active', 1]])
        // ->get();
    }
}
