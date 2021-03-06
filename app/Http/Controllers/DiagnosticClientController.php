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


    public function showClient($clientId)
    {
        return DiagnosticClient::activeClient($clientId);
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

            'client_id'     => $request['client_id'],
            // 'client_id'     => 1,
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


    public function update(Request $request, DiagnosticClient $diagnosticClient)
    {
        //
    }



    public function updateClient(Request $request)
    {

        Validator::make($request->all(), [

            'diagnostic_id' => ['required'],
            'date'          => ['required'],

        ])->validate();

        // modify Diagnostic
        $diagnostic = DiagnosticClient::find($request['id']);
        $diagnostic->diagnostic_id = $request['diagnostic_id'];
        $diagnostic->date          = $request['date'];
        $diagnostic->comments      = $request['comments'];

        $diagnostic->save();

        return Diagnostic::getDiagnostics($request['id']);
    }



    public function deleteClient($id)
    {
        $diagnostic = DiagnosticClient::find($id);
        $diagnostic->active = 0;
        $diagnostic->save();

        return $diagnostic;
    }


    public function destroy(DiagnosticClient $diagnosticClient)
    {
        //
    }
}
