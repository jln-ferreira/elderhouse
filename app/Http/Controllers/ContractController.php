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


    public function create()
    {
        //
    }


    public function storeContract(Request $request)
    {
        $nameContract = date('Y-m-d') . '.' . $request['number'];
        move_uploaded_file($request['pdf'],"storage/storage/uploads/contracts/" . $nameContract . ".pdf" );

        return $nameContract;
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
