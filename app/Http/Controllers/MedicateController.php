<?php

namespace App\Http\Controllers;

use App\Medicate;
use App\Rebate;
use DateTime;

use Illuminate\Http\Request;

class MedicateController extends Controller
{
    public function index()
    {
        return Medicate::getClientProducts();
    }

    public function getMedicates()
    {
        return Medicate::getMedicates();
    }


    public function store(Request $request)
    {

    }

    public function storeMedicateOrRebate(Request $request)
    {
        // get todays date
        $date = new DateTime("now", new \DateTimeZone('America/Sao_Paulo') );
        $date = $date->format('Y-m-d');

        // MEDICATE x REBATE
        // CHECKMEDICATE = TRUE -> MEDICATE
        if($request['ckeckMedicate'] == true)
        {
           //save new medicates
            $medicates = Medicate::create([
                'user_id'            => $request['userId'],
                'client_products_id' => $request['client_product_id'],
                'date'               => $date,
                'comment'            => $request['comment']
            ]);

            return Medicate::getClientProduct($medicates->id);
        }

        //save new Rebate
        $rebate = Rebate::updateOrCreate(
            [
                'user_id'            => $request['userId'],
                'client_products_id' => $request['client_product_id'],
                'date'               => $date,
            ],
            [
                'user_id'            => $request['userId'],
                'client_products_id' => $request['client_product_id'],
                'date'               => $request['date'],
                'comment'            => $request['commentRebate'],
                'product_id'         => $request['productId']
            ]
        );

        $rebate->save();

        return Rebate::getRebate($rebate->id);
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
