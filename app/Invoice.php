<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Invoice extends Model
{
    protected $guarded = [];


    public static function getInvoices()
    {
        return DB::table('invoices')
        ->select('invoices.id', 'invoices.client_id', 'clients.name AS client_name','clients.phonenumber AS client_phonenumber', 'clients.surname AS client_surname', 'invoices.date', 'invoices.value', 'invoices.payDate')
        ->leftJoin('clients', 'invoices.client_id', '=', 'clients.id')
        ->where('invoices.active', 1)
        ->orderBy('invoices.payDate')
        ->get();
    }


    public static function getPaymentDates($clientId)
    {
        return DB::table('payments')
        ->selectRaw('LEFT(date, 7) AS date')
        ->where('payments.client_id', $clientId)
        ->orderBy('payments.date')
        ->distinct()
        ->get();
    }


    public static function createInvoice($request)
    {
        $date = explode('-', $request->date);

        return DB::table('payments')
        ->select('payments.id', 'payments.client_id', 'clients.name AS client_name','clients.phonenumber AS client_phonenumber', 'clients.surname AS client_surname','addresses.street','addresses.number','addresses.city','addresses.state','addresses.country', 'precifications.name AS precification_name', 'precifications.comment AS precification_comment',  'payments.value AS payment_value', 'payments.date AS payment_date', 'payments.comment')
        ->leftJoin('clients', 'payments.client_id', '=', 'clients.id')
        ->leftJoin('precifications', 'payments.precification_id', '=', 'precifications.id')
        ->leftJoin('addresses', 'clients.id', '=', 'addresses.client_id')
        ->where([['payments.active', 1],['precifications.active', 1], ['payments.client_id', $request->clientId]])
        ->whereYear('payments.date', '=', $date[0])
        ->whereMonth('payments.date', '=', $date[1])
        ->orderBy('payments.date')
        ->get();
    }
}
