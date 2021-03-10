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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'rank' => ['required', 'integer'],
        ])->validate();


        // DIAGNOSTIC
        $diagnostic = Diagnostic::Create([
            'name' => $request['name'],
            'rank' => $request['rank'],
        ]);
        $diagnostic->save();


        return $diagnostic;
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


    public function update(Request $request)
    {

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'rank' => ['required', 'integer'],
        ])->validate();

        // modify diagnostic
        $diagnostic = Diagnostic::find($request['id']);
        $diagnostic->name = $request['name'];
        $diagnostic->rank = $request['rank'];
        $diagnostic->save();


        return $diagnostic;

    }

    public function destroy($diagnosticId)
    {
        $diagnostic = Diagnostic::find($diagnosticId);
        $diagnostic->active = 0;
        $diagnostic->save();

        return $diagnostic;
    }
}
