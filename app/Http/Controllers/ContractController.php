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


    public function store(Request $request)
    {

        move_uploaded_file($request['pdf'],"storage/storage/uploads/contracts/contrato.pdf" );
        return $request;




        // // save contract
        // $image = $request->photo;

        // $image = str_replace('data:image/png;base64,', '', $image);
        // $decoded = base64_decode($image);

        // file_put_contents("storage/storage/uploads/contracts/contrato.png", $decoded, LOCK_EX);


        // return $image;


            // $contents = file_get_contents($request->photo);
            // $newPath = $request->photo->store('public/storage/uploads/images_clients');

            // $name = explode('/', $newPath);
            // return $name[4];


        // $folderPath = public_path('\storage\storage\uploads\signatures\\');

	    // $image_parts = explode(";base64,", $request);

	    // $image_type_aux = explode("image/", $image_parts[0]);

	    // $image_type = $image_type_aux[1];

	    // $image_base64 = base64_decode($image_parts[1]);

	    // $file = $folderPath . uniqid() . '.'.$image_type;
	    // file_put_contents($file, $image_base64);


        // return $image_type;
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
