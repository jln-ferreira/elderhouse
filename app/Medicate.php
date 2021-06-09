<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Medicate extends Model
{
    protected $guarded = [];


    // GET ALL Client_Products of today
    public static function getClientProducts()
    {
        date_default_timezone_set ( 'America/Sao_Paulo' );

        return DB::table('client_products')
        ->select(
            'client_products.id',
            'client_products.client_id',
            'clients.name','clients.surname',
            'clients.appartament',
            'products.id AS productId',
            'products.name AS productName',
            'client_products.measurement_id',
            'measurements.name AS measurementName',
            'client_products.quantity',
            'client_products.date',
            'client_products.time',
            'client_products.comment',
            'medicates.id AS medicate_id',
            'rebates.id AS rebate_id'
        )
        ->leftJoin('products', 'client_products.product_id', '=', 'products.id')
        ->leftJoin('clients', 'client_products.client_id', '=', 'clients.id')
        ->leftJoin('measurements', 'client_products.measurement_id', '=', 'measurements.id')
        ->leftJoin('medicates', 'client_products.id', '=', 'medicates.client_products_id')
        ->leftJoin('rebates', 'client_products.id', '=', 'rebates.client_products_id')
        ->where([['client_products.active', 1],['clients.active', 1], ['products.active', 1],['medicates.id', NULL], ['client_products.date', date('Y-m-d')]])
        ->orderBy('client_products.time')
        ->get();
    }


    // GET Client_Products by ID
    public static function getClientProduct($id)
    {
        date_default_timezone_set ( 'America/Sao_Paulo' );

        return DB::table('client_products')
        ->select('client_products.id', 'medicates.id AS medicate_id')
        ->leftJoin('medicates', 'client_products.id', '=', 'medicates.client_products_id')
        ->where([['medicates.id', $id], ['client_products.active', 1]])
        ->get();
    }

}
