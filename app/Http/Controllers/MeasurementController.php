<?php

namespace App\Http\Controllers;

use App\Measurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Measurement::where('active', 1)->get();
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
        Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:30'],
            'measurement' => ['required', 'string', 'max:10'],
            'comment'     => ['max:100'],
        ])->validate();


        // MEASUREMENT
        $measurement = Measurement::Create([
            'name'        => $request['name'],
            'measurement' => $request['measurement'],
            'comment'     => $request['comment'],
        ]);
        $measurement->save();


        return $measurement;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function show(measurement $measurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function edit(measurement $measurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:30'],
            'measurement' => ['required', 'string', 'max:10'],
            'comment'     => ['max:100'],
        ])->validate();

        // modify measurement
        $measurement = Measurement::find($request['id']);
        $measurement->name = $request['name'];
        $measurement->measurement = $request['measurement'];
        $measurement->comment = $request['comment'];
        $measurement->save();


        return $measurement;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\measurement  $measurement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $measurement = Measurement::find($id);
        $measurement->active = 0;
        $measurement->save();

        return $measurement;
    }
}
