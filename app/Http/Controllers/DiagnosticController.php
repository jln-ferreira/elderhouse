<?php

namespace App\Http\Controllers;

use App\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Diagnostic::where('active', 1)->get();
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnostic $diagnostic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnostic  $diagnostic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostic $diagnostic)
    {
        //
    }
}
