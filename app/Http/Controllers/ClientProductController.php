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
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
