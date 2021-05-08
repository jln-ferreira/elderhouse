<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];


    public static function activePayments()
    {
        return DB::table('payments')
        ->select('payments.id', 'clients.id AS clientId', 'clients.name AS clientName', 'clients.surname AS clientSurname', 'precifications.id AS precificationId', 'precifications.name AS precificationName', 'precifications.price', 'payments.value', 'payments.date', 'payments.comment','payments.invoice_id')
        ->leftJoin('precifications', 'payments.precification_id', '=', 'precifications.id')
        ->leftJoin('clients', 'payments.client_id', '=', 'clients.id')
        ->where('payments.active', 1)
        ->orderBy('payments.date', 'DESC')
        ->get();
    }

    public static function activePayment($id)
    {
        return DB::table('payments')
        ->select('payments.id', 'clients.id AS clientId', 'clients.name AS clientName', 'clients.surname AS clientSurname', 'precifications.id AS precificationId', 'precifications.name AS precificationName', 'precifications.price', 'payments.value', 'payments.date', 'payments.comment','payments.invoice_id')
        ->leftJoin('precifications', 'payments.precification_id', '=', 'precifications.id')
        ->leftJoin('clients', 'payments.client_id', '=', 'clients.id')
        ->where([['payments.active', 1], ['payments.id', $id]])
        ->orderBy('payments.date', 'DESC')
        ->get();
    }

}
