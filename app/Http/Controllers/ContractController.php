<?php

namespace App\Http\Controllers;

use App\Contract;

use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        //
    }


    // SAVE NEW CONTRACT SERVER SITE
    public function storeContract(Request $request)
    {
        $nameContract = date('Y-m-d') . '.' . $request['number'];
        move_uploaded_file($request['pdf'],"storage/storage/uploads/contracts/" . $nameContract . ".pdf" );

        return $nameContract;
    }


    // SAVE CONTRACT ON DATABASE
    public function create(Request $request)
    {
        //save new contract
        $contract = Contract::create([
            'client_id'    => $request['contractInfo']['clientId'],
            'user_id'      => $request['contractInfo']['userId'],
            'family_id'    => $request['contractInfo']['familyId'],
            'contract_url' => $request['contract_name'],
            'date'         => date('Y-m-d'),
            'comments'     => $request['contractInfo']['comments'],
        ]);

        return $contract;
    }





    public function show(Contract $contract)
    {
        //
    }


    public function fullShow($clientId)
    {
        return Contract::getFullContract($clientId);
    }



    public function edit(Contract $contract)
    {
        //
    }


    public function update(Request $request, Contract $contract)
    {
        //
    }


    public function destroy(Contract $contract)
    {
        //
    }
}
