<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class clientProduct extends Model
{
    protected $guarded = [];

    // GET ALL Client_Products
    public static function getClientProducts()
    {
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
            'client_products.comment'
        )
        ->leftJoin('products', 'client_products.product_id', '=', 'products.id')
        ->leftJoin('clients', 'client_products.client_id', '=', 'clients.id')
        ->leftJoin('measurements', 'client_products.measurement_id', '=', 'measurements.id')
        ->where([['client_products.active', 1],['clients.active', 1], ['products.active', 1]])
        ->get();
    }

    // GET especific Client_Products
    public static function getClientProduct($id)
    {
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
            'client_products.comment'
        )
        ->leftJoin('products', 'client_products.product_id', '=', 'products.id')
        ->leftJoin('clients', 'client_products.client_id', '=', 'clients.id')
        ->leftJoin('measurements', 'client_products.measurement_id', '=', 'measurements.id')
        ->where([['client_products.active', 1],['clients.active', 1], ['products.active', 1], ['client_products.id', $id]])
        ->get();
    }
}
