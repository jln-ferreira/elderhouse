<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invoice extends Model
{
    public static function getPaymentDates($clientId)
    {
        return DB::table('payments')
        ->selectRaw('LEFT(date, 7) AS date')
        ->where('payments.client_id', $clientId)
        ->orderBy('payments.date')
        ->distinct()
        ->get();
    }


    public static function getInvoice($request)
    {
        return DB::table('payments')
        ->select('payments.id', 'payments.client_id', 'clients.name AS client_name', 'clients.surname AS client_surname','addresses.street','addresses.number','addresses.city','addresses.state','addresses.country', 'precifications.name AS precification_name', 'precifications.comment AS precification_comment',  'payments.value AS payment_value', 'payments.date AS payment_date', 'payments.comment')
        ->leftJoin('clients', 'payments.client_id', '=', 'clients.id')
        ->leftJoin('precifications', 'payments.precification_id', '=', 'precifications.id')
        ->leftJoin('addresses', 'clients.id', '=', 'addresses.client_id')
        ->where([['payments.active', 1],['precifications.active', 1]])
        ->orderBy('payments.date')
        ->get();
    }
}