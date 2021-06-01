<?php

namespace App\Http\Controllers;

use App\Medicate;
use Illuminate\Http\Request;

class MedicateController extends Controller
{
    public function index()
    {
        return Medicate::getClientProducts();
    }


    public function store(Request $request)
    {
        //save new medicates
        $medicates = Medicate::create([
            'user_id'            => $request['userId'],
            'client_products_id' => $request['client_product_id'],
            'date'               => $request['date'],
            'comment'            => $request['comment']
        ]);

        return Medicate::getClientProduct($medicates->id);
    }



    public function update(Request $request, medicate $medicate)
    {
        //
    }


    public function destroy(medicate $medicate)
    {
        //
    }
}
