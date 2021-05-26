<?php

namespace App\Http\Controllers;

use App\Medicate;
use Illuminate\Http\Request;

class MedicateController extends Controller
{
    public function index()
    {
        return Medicate::getClientProducts();
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
     * @param  \App\medicate  $medicate
     * @return \Illuminate\Http\Response
     */
    public function show(medicate $medicate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicate  $medicate
     * @return \Illuminate\Http\Response
     */
    public function edit(medicate $medicate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicate  $medicate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, medicate $medicate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medicate  $medicate
     * @return \Illuminate\Http\Response
     */
    public function destroy(medicate $medicate)
    {
        //
    }
}
