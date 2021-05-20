<?php

namespace App\Http\Controllers;

use App\clientProduct;
use App\ProductCategory;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\DateTime;
use App\Xelance;

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

            return clientProduct::getClientProduct($clientProduct->id);
        }
        // CUSTOM SCHEDULING
        else
        {
            Validator::make($request->all(), [
                'week' => ['required', 'min:1'],
            ])->validate();

            //loop trought all dates
            $clientProductsId = [];
            $today = date("Y-m-d");
            $weekCount = 7;
            for ($i=0; $i < $weekCount * intval($request['repeat']); $i++)
            {
                foreach ($request['week'] as $key => $day)
                {
                    if($day == date('N', strtotime($today)))
                    {
                        $clientProduct = clientProduct::create([
                            'client_id'      => $request['clientId'],
                            'product_id'     => $request['productId'],
                            'measurement_id' => $request['measurementId'],
                            'quantity'       => $request['quantity'],
                            'user_id'        => $request['userId'],
                            'date'           => $today,
                            'time'           => $request['time'],
                            'comment'        => $request['comment']
                        ]);

                        //push ID to clientProductsId
                        array_push($clientProductsId, $clientProduct->id);
                        break;
                    }
                }
                $today = date("Y-m-d", strtotime($today . "+ 1 days"));
            }

            //full object comming from Client_Product
            $clientProducts = [];
            foreach ($clientProductsId as $value) array_push($clientProducts, clientProduct::getClientProduct($value)[0]);

            return $clientProducts;
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
