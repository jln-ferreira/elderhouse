<?php

namespace App\Http\Controllers;

use App\Client;
use App\Specification;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//photo
use Illuminate\Http\UploadedFile;


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


    // SAVE PHOTO
    public function photoClient(Request $request)
    {
        if(isset($request->photo)){
            // Validate (size is in KB)
            $request->validate([
                'photo' => 'nullable|file|image',
            ]);

            $contents = file_get_contents($request->photo->path());
            $newPath = $request->photo->store('public/storage/uploads/images_clients');

            $name = explode('/', $newPath);
            return $name[4];
        } else return '';
    }


    public function create(Request $request)
    {
        Validator::make($request->all(), [

            'name'        => ['required', 'string', 'max:100'],
            'surname'     => ['required', 'string', 'max:100'],
            'datastart'   => ['required', 'date'],
            'databirth'   => ['required', 'date'],
            'phonenumber' => ['required', 'numeric', 'digits_between:8,10'],
            'appartament' => ['nullable', 'numeric', 'max:40', 'min:0'],
            'CPF'         => ['required', 'numeric','digits_between:10,12'],
            'RG'          => ['required', 'numeric','digits_between:9,10'],
            'gender'      => ['required', 'nullable'],
            'height'      => ['nullable', 'numeric'],
            'color'       => ['required'],
            'religion'    => ['required'],
            'ocupation'   => ['max:500'],

        ])->validate();

        // FIND URL
        $url = true;
        $findURL = Client::find($request['clientId']);
        if(isset($findURL)){
            if ($request['url'] != '') $url = $request['url'];
            else $url = $findURL->url;
        }else{
            $url = $request['url'];
        }


        // CLIENT
        $client = Client::updateOrCreate(
            [
                'id'        => $request['clientId'],
            ],
            [
                'name'        => $request['name'],
                'surname'     => $request['surname'],
                'datastart'   => $request['datastart'],
                // 'url'         => $request['url'],
                'url'         => $url,
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


    public function destroy($id)
    {
        $client = Client::find($id);
        $client->active = 0;
        $client->save();

        return $client;
    }


}
