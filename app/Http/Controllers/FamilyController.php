<?php

namespace App\Http\Controllers;

use App\Family;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
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



    public function create(Request $request)
    {
        Validator::make($request->all(), [

            'name'        => ['required', 'string', 'max:100'],
            'surname'     => ['required', 'string', 'max:100'],
            'parent'      => ['required', 'string', 'max:100'],
            'gender'      => ['required'],
            'phonenumber' => ['required', 'numeric'],
            'email'       => ['required', 'string', 'max:100'],
            'responsable' => ['required']

        ])->validate();


        // FAMILY
        $family = Family::Create([

            'client_id'   => $request['client_id'],
            'name'        => $request['name'],
            'surname'     => $request['surname'],
            'parent'      => $request['parent'],
            'gender'      => $request['gender'],
            'phonenumber' => $request['phonenumber'],
            'email'       => $request['email'],
            'responsable' => $request['responsable'],
        ]);
        $family->save();


        return $family;
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
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        //
    }
}
