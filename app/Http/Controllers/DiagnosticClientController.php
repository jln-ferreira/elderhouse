<?php

namespace App\Http\Controllers;

use App\DiagnosticClient;
use App\Diagnostic;
use DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosticClientController extends Controller
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

    public function store(Request $request)
    {
        Validator::make($request->all(), [

            'diagnostic_id' => ['required'],
            'date'          => ['required'],

        ])->validate();

        // DIAGNOSTIC
        $diagnostic = DiagnosticClient::Create([

            // 'client_id'     => $request['client_id'],
            'client_id'     => 1,
            'diagnostic_id' => $request['diagnostic_id'],
            'date'          => $request['date'],
            'comments'      => $request['comments'],

        ]);
        $diagnostic->save();


        $diagnosticReturn = Diagnostic::getDiagnostics($diagnostic->id);

        return $diagnosticReturn;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DiagnosticClient  $diagnosticClient
     * @return \Illuminate\Http\Response
     */
    public function show(DiagnosticClient $diagnosticClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiagnosticClient  $diagnosticClient
     * @return \Illuminate\Http\Response
     */
    public function edit(DiagnosticClient $diagnosticClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiagnosticClient  $diagnosticClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiagnosticClient $diagnosticClient)
    {
        //
    }

    public function deleteClient($userId)
    {
        $diagnostic = DiagnosticClient::find($userId);
        $diagnostic->active = 0;
        $diagnostic->save();

        return $diagnostic;
    }


    public function destroy(DiagnosticClient $diagnosticClient)
    {
        //
    }
}
