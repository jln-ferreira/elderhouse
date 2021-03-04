<?php

namespace App\Http\Controllers;

use App\Bankaccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankaccountController extends Controller
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
        return Bankaccount::activeClient($clientId);
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
        //
    }

    public function createClient(Request $request)
    {
        Validator::make($request->all(), [

            'nameCard'        => ['required', 'string'],
            'numberCard'      => ['required', 'numeric', 'digits_between:10,12'],
            'expirationMonth' => ['required', 'max:12', 'min:1'],
            'expirationYear'  => ['required'],
            'expirationCVV'   => ['required', 'numeric', 'max:999', 'min:1'],

        ])->validate();

        $expirationDate = $request['expirationMonth'] . '/' . $request['expirationYear'];

        // Bank Account
        $bankAccount = Bankaccount::updateOrCreate(
            [
                'id'        => $request['id'],
                'client_id' => $request['clientId'],
            ],
            [
                'client_id'       => $request['clientId'],
                'name_card'       => $request['nameCard'],
                'card_number'     => $request['numberCard'],
                'expiration_date' => $expirationDate,
                'cvv'             => $request['expirationCVV'],

            ]
        );
        $bankAccount->save();


        return $bankAccount;
    }

    public function show(Bankaccount $bankaccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bankaccount  $bankaccount
     * @return \Illuminate\Http\Response
     */
    public function edit(Bankaccount $bankaccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bankaccount  $bankaccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bankaccount $bankaccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bankaccount  $bankaccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bankaccount $bankaccount)
    {
        //
    }
}
