<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{


    public function index()
    {
        return Product::allProducts();
    }



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
    }



    public function show(product $product)
    {
        //
    }


    public function edit(product $product)
    {
        //
    }


    public function update(Request $request)
    {
        Validator::make($request->all(), [

            'name'               => ['required', 'string', 'max:100'],
            'measurement'        => ['required'],
            'checkedCategories'  => ['required'],

        ])->validate();

        // modify product
        $product = Product::find($request['id']);
        $product->name        = $request['name'];
        $product->measurement = $request['measurement'];
        $product->comment     = $request['comment'];
        $product->save();


        // modify categories
        ProductCategory::where([['active', 1],['product_id', $request['id']]])->update(['active' => 0]);

        foreach($request['checkedCategories'] as $key => $value) {
            ProductCategory::updateOrCreate(
                [
                    'product_id'  => $request['id'],
                    'category_id' => $value
                ],
                [
                    'category_id' => $value,
                    'active'      => 1
                ]
            );
        };

        return Product::getProduct($request['id']);
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
