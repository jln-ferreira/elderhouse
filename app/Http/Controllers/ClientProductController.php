<?php

namespace App\Http\Controllers;

use App\clientProduct;
use App\ProductCategory;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return clientProduct::getClientProducts();
    }


    public function store(Request $request)
    {
        // SINGLE SCHEDULING
        if(empty($request['week']))
        {
            //save new clientProduct
            $clientProduct = clientProduct::create([
                'client_id'      => $request['clientId'],
                'product_id'     => $request['productId'],
                'measurement_id' => $request['measurementId'],
                'quantity'       => $request['quantity'],
                'user_id'        => $request['userId'],
                'date'           => $request['date'],
                'time'           => $request['time'],
                'comment'        => $request['comment']
            ]);

            return $clientProduct;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\clientProduct  $clientProduct
     * @return \Illuminate\Http\Response
     */
    public function show(clientProduct $clientProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\clientProduct  $clientProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(clientProduct $clientProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\clientProduct  $clientProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, clientProduct $clientProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\clientProduct  $clientProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(clientProduct $clientProduct)
    {
        //
    }

    // GET ALL PRODUCTS WITH CATEGORY MEDIC
    public function getProducts()
    {
        return ProductCategory::getProducts();
    }
}
