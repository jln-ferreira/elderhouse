<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = [];


    // GET ALL PRODUCTS WITH CATEGORY MEDIC
    public static function getProducts()
    {
        return DB::table('product_categories')
        ->select('products.id', 'products.name')
        ->leftJoin('products', 'product_categories.product_id', '=', 'products.id')
        ->leftJoin('categories', 'product_categories.category', '=', 'categories.id')
        ->where('categories.id', 4) //4 = Medic (can be changed )
        ->orderBy('products.name')
        ->get();
    }
}
