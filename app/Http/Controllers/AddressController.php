<?php

namespace App\Http\Controllers;

use App\Address;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{

    public function showClient($clientId)
    {
        return Address::activeClient($clientId);
    }

    public function createClient(Request $request)
    {
        Validator::make($request->all(), [

            'street'    => ['required', 'string'],
            'number'    => ['required', 'numeric', 'min:1'],
            'city'      => ['required', 'string'],
            'state'     => ['required', 'string'],
            'country'   => ['required', 'string'],

        ])->validate();


        // ADDRESS
        $address = Address::updateOrCreate(
            [
                'id'        => $request['id'],
                'client_id' => $request['client_id'],
            ],
            [
                'client_id' => $request['client_id'],
                'street'    => $request['street'],
                'number'    => $request['number'],
                'city'      => $request['city'],
                'state'     => $request['state'],
                'country'   => $request['country'],

            ]
        );
        $address->save();


        return $address;
    }


}
