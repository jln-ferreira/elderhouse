<?php

namespace App\Http\Controllers;

use App\Client;
use App\Specification;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{


    public function index()
    {
        return Client::activeclients();
    }


    public function create(Request $request)
    {
        Validator::make($request->all(), [

            'name'       => ['required', 'string', 'max:100'],
            'surname'    => ['required', 'string', 'max:100'],
            'datastart'  => ['required', 'date'],
            'photo'      => ['nullable'],
            'databirth'  => ['required', 'date'],
            'phonenumber'=> ['required', 'numeric', 'max:999999999'],
            'appartament'=> ['nullable', 'numeric', 'max:40', 'min:0'],
            'gender'     => ['required', 'nullable'],
            'height'     => ['nullable', 'numeric'],
            'color'      => ['required'],
            'religion'   => ['required'],
            'ocupation'  => ['max:500'],

        ])->validate();


        // CLIENT
        $client = Client::updateOrCreate(
            [
                'id'        => $request['id'],
            ],
            [
                'name'        => $request['name'],
                'surname'     => $request['surname'],
                'datastart'   => $request['datastart'],
                'url'         => $request['photoName'],
                'databirth'   => $request['databirth'],
                'phonenumber' => $request['phonenumber'],
                'appartament' => $request['appartament'],
            ]
        );
        $client->save();


        // INFORMATION
        $specification = Specification::updateOrCreate(
            [
                'client_id'   =>  $client->id,
            ],
            [
                'client_id' => $client->id,
                'CPF'       => $request['CPF'],
                'RG'        => $request['RG'],
                'otherdoc'  => $request['otherdoc'],
                'gender'    => $request['gender'],
                'height'    => $request['height'],
                'color'     => $request['color'],
                'religion'  => $request['religion'],
                'available' => $request['available'],
                'ocupation' => $request['ocupation'],
            ]
        );
        $specification->save();


        // SAVE IMAGE


        return response([
            'client'      => $client,
            'specification' => $specification
        ], 200);
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
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
