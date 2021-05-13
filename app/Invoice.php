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

    public static function getInvoice($id)
    {
        $invoices =  DB::table('payments')
        ->select('invoices.id AS id','invoices.date AS invoice_date','invoices.value AS invoice_value','invoices.payDate','payments.id AS payment_id', 'payments.client_id', 'clients.name AS client_name','clients.phonenumber AS client_phonenumber', 'clients.surname AS client_surname','addresses.street','addresses.number','addresses.city','addresses.state','addresses.country', 'precifications.name AS precification_name', 'precifications.comment AS precification_comment',  'payments.value AS payment_value', 'payments.date AS payment_date', 'payments.comment', 'payments.invoice_id')
        ->leftJoin('invoices', 'payments.invoice_id', '=', 'invoices.id')
        ->leftJoin('clients', 'payments.client_id', '=', 'clients.id')
        ->leftJoin('precifications', 'payments.precification_id', '=', 'precifications.id')
        ->leftJoin('addresses', 'clients.id', '=', 'addresses.client_id')
        ->where([['precifications.active', 1], ['invoices.id', $id]])
        ->orderBy('payments.date')
        ->get();

        // design new array
        $result = [];
        foreach ($invoices as $invoice)
        {
            $result[$invoice->id]['id'] = $invoice->id;
            $result[$invoice->id]['invoice_value'] = $invoice->invoice_value;
            $result[$invoice->id]['invoice_date'] = $invoice->invoice_date;
            $result[$invoice->id]['payDate'] = $invoice->payDate;
            $result[$invoice->id]['client_id'] = $invoice->client_id;
            $result[$invoice->id]['client_name'] = $invoice->client_name . ' ' . $invoice->client_surname;
            $result[$invoice->id]['client_phonenumber'] = $invoice->client_phonenumber;
            $result[$invoice->id]['country'] = $invoice->country;
            $result[$invoice->id]['city'] = $invoice->city;
            $result[$invoice->id]['state'] = $invoice->state;
            $result[$invoice->id]['street'] = $invoice->street;
            $result[$invoice->id]['number'] = $invoice->number;
            $result[$invoice->id]['payments'][] = array(
                'payment_id' => $invoice->payment_id,
                'payment_value' => $invoice->payment_value,
                'payment_date' => $invoice->payment_date,
                'precification_name' => $invoice->precification_name,
                'precification_comment' => $invoice->precification_comment,
                'comment' => $invoice->comment
            );
        }

        // to array
        $resultArray = [];
        foreach ($result as $value) {
            array_push($resultArray, $value);
        };

        return $resultArray[0];
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
        ->select('payments.id', 'payments.client_id', 'clients.name AS client_name','clients.phonenumber AS client_phonenumber', 'clients.surname AS client_surname','addresses.street','addresses.number','addresses.city','addresses.state','addresses.country', 'precifications.name AS precification_name', 'precifications.comment AS precification_comment',  'payments.value AS payment_value', 'payments.date AS payment_date', 'payments.comment', 'payments.invoice_id')
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
