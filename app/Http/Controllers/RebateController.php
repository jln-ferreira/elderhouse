<?php

namespace App\Http\Controllers;

use App\Rebate;
use Illuminate\Http\Request;

class RebateController extends Controller
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

    public function getRebates()
    {
        return Rebate::getRebates();
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
     * @param  \App\rebate  $rebate
     * @return \Illuminate\Http\Response
     */
    public function show(rebate $rebate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rebate  $rebate
     * @return \Illuminate\Http\Response
     */
    public function edit(rebate $rebate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rebate  $rebate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rebate $rebate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rebate  $rebate
     * @return \Illuminate\Http\Response
     */
    public function destroy(rebate $rebate)
    {
        //
    }
}
