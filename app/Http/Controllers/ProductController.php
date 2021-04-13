<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::allProducts();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [

            'name'               => ['required', 'string', 'max:100'],
            'measurement'        => ['required'],
            'checkedCategories'  => ['required'],

        ])->validate();

        // PRODUCTS
        $product = Product::Create([

            'name'        => $request['name'],
            'measurement' => $request['measurement'],
            'comment'     => $request['comment'],

        ]);
        $product->save();

        // save product_category
        foreach ($request['checkedCategories'] as $category) {
            ProductCategory::create([
                'category_id' => $category,
                'product_id'  => $product->id
            ]);
        }

        return Product::getProduct($product->id);

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $product = Product::find($productId);
        $product->active = 0;
        $product->save();

        return $product;
    }
}
