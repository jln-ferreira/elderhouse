<?php

namespace App\Http\Controllers;

use App\Address;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{


    public function createClient(Request $request)
    {
        Validator::make($request->all(), [

            'street'    => ['required', 'string', 'max:100'],
            'number'    => ['required', 'numeric', 'max:100'],
            'city'      => ['required', 'string', 'max:100'],
            'state'     => ['required', 'string', 'max:100'],
            'country'   => ['required', 'string', 'max:100'],

        ])->validate();


        // ADDRESS
        $address = Address::updateOrCreate(
            [
                'client_id'   => $request['client_id'],
            ],
            [
                'street'  => $request['street'],
                'number'  => $request['number'],
                'city'    => $request['city'],
                'state'   => $request['state'],
                'country' => $request['country'],

            ]
        );
        $address->save();


        return $address;
    }


}
