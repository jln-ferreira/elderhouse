<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public static function allProducts()
    {
        $products = DB::table('product_categories')
                    ->select("products.id",
                    "products.name",
                    "products.measurement AS measurement_id",
                    "measurements.measurement AS measurements_name",
                    "products.comment",
                    "products.quantity",
                    "categories.id AS categories_id",
                    "categories.name AS categories_name")
                    ->leftJoin('products', 'product_categories.product_id', '=', 'products.id')
                    ->leftJoin('categories', 'product_categories.category_id', '=', 'categories.id')
                    ->leftJoin('measurements', 'products.measurement', '=', 'measurements.id')
                    ->where([
                        ["products.active", "=", 1],
                        ["categories.active", "=", 1],
                        ["product_categories.active", "=", 1],
                        ["measurements.active", "=", 1]
                    ])
                    ->get();

        // design new array
        $result = [];
        foreach ($products as $product)
        {
            $result[$product->id]['id'] = $product->id;
            $result[$product->id]['name'] = $product->name;
            $result[$product->id]['measurement_id'] = $product->measurement_id;
            $result[$product->id]['measurements_name'] = $product->measurements_name;
            $result[$product->id]['comment'] = $product->comment;
            $result[$product->id]['quantity'] = $product->quantity;
            $result[$product->id]['categories'][] = array('category_id' => $product->categories_id, 'category_name' => $product->categories_name);
        }

        // to array
        $resultArray = [];
        foreach ($result as $value) {
            array_push($resultArray, $value);
        };

        return $resultArray;
    }



    public static function getProduct($id)
    {
        $products = DB::table('product_categories')
                    ->select("products.id",
                    "products.name",
                    "products.measurement AS measurement_id",
                    "measurements.measurement AS measurements_name",
                    "products.comment",
                    "products.quantity",
                    "categories.id AS categories_id",
                    "categories.name AS categories_name")
                    ->leftJoin('products', 'product_categories.product_id', '=', 'products.id')
                    ->leftJoin('categories', 'product_categories.category_id', '=', 'categories.id')
                    ->leftJoin('measurements', 'products.measurement', '=', 'measurements.id')
                    ->where([
                        ["products.active", "=", 1],
                        ["categories.active", "=", 1],
                        ["product_categories.active", "=", 1],
                        ["measurements.active", "=", 1],
                        ["products.id", "=", $id],
                    ])
                    ->get();

        // design new array
        $result = [];
        foreach ($products as $product)
        {
            $result[$product->id]['id'] = $product->id;
            $result[$product->id]['name'] = $product->name;
            $result[$product->id]['measurement_id'] = $product->measurement_id;
            $result[$product->id]['measurements_name'] = $product->measurements_name;
            $result[$product->id]['comment'] = $product->comment;
            $result[$product->id]['quantity'] = $product->quantity;
            $result[$product->id]['categories'][] = array('category_id' => $product->categories_id, 'category_name' => $product->categories_name);
        }

        // to array
        $resultArray = [];
        foreach ($result as $value) {
            array_push($resultArray, $value);
        };

        return $resultArray;
    }
}
