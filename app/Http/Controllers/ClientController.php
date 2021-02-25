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


    public function show($clientId)
    {
        return Client::activeclient($clientId);
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


    public function store(Request $request)
    {
        //
    }


    public function edit(Client $client)
    {
        //
    }


    public function update(Request $request)
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

        // // modify CLIENT
        $client = Client::find($request['clientId']);

        $client->name        = $request['name'];
        $client->surname     = $request['surname'];
        $client->datastart   = $request['datastart'];
        $client->url         = $request['url'];
        $client->databirth   = $request['databirth'];
        $client->phonenumber = $request['phonenumber'];
        $client->appartament = $request['appartament'];

        $client->save();

        // // modify SPECIFICATION
        $specification = Specification::find($request['infoId']);

        $specification->CPF       = $request['CPF'];
        $specification->RG        = $request['RG'];
        $specification->otherdoc  = $request['otherdoc'];
        $specification->gender    = $request['gender'];
        $specification->height    = $request['height'];
        $specification->color     = $request['color'];
        $specification->religion  = $request['religion'];
        $specification->available = $request['available'];
        $specification->ocupation = $request['ocupation'];

        $specification->save();



        return ['client' => $client, 'specification' => $specification];
    }

    public function destroy(Client $client)
    {
        //
    }

}
