<?php

namespace App\Http\Controllers;

use App\Invoice;
use DB;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return Invoice::getInvoices();
    }


    public function show($id)
    {
        return Invoice::getInvoice($id);
    }


    public function store(Request $request)
    {
        // update app payments
        $date = explode('-',  $request['date']);

        // invoice
        $invoice = Invoice::updateOrCreate(
            [
                'client_id' => $request['clientId'],
                'date'      => $date[0] . '-' . $date[1],
            ],
            [
                'client_id' => $request['clientId'],
                'date'      => $request['date'],
                'value'     => $request['value'],
                'payDate'   => $request['payDate'],
                'active'    => 1
            ]
        );
        $invoice->save();

        //fill invoice_id on payments itens
        $payments = DB::table('payments')
        ->where([['payments.active', 1], ['payments.client_id', $request['clientId']]])
        ->whereYear('payments.date', '=', $date[0])
        ->whereMonth('payments.date', '=', $date[1])
        ->update(['invoice_id' => $invoice->id]);

        //send full information
        $invoicesClient = DB::table('invoices')
        ->select('invoices.id', 'invoices.date', 'invoices.value', 'invoices.payDate', 'invoices.client_id', 'clients.name AS client_name', 'clients.surname AS client_surname')
        ->leftJoin('clients', 'invoices.client_id', '=', 'clients.id')
        ->where([['invoices.id', $invoice->id]])
        ->get();

        return $invoicesClient;
    }


    public function update(Request $request, invoice $invoice)
    {
        //
    }


    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->active = 0;
        $invoice->save();

        $date = explode('-',  $invoice->date);

        // update value of payments
        $payments = DB::table('payments')
        ->where([['payments.active', 1], ['payments.client_id', $invoice->client_id]])
        ->whereYear('payments.date', '=', $date[0])
        ->whereMonth('payments.date', '=', $date[1])
        ->update(['invoice_id' => NULL]);

        return $invoice;
    }


    public function getPaymentDates($clientId)
    {
        return Invoice::getPaymentDates($clientId);
    }

    //SHOW INVOICE AFTER SELECT CLIENT AND DATE
    public function createInvoice(Request $request)
    {
        return Invoice::createInvoice($request);
    }
}
