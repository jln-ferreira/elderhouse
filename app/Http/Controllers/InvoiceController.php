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
        // invoice
        $invoice = Invoice::Create([
            'client_id' => $request['clientId'],
            'date'      => $request['date'],
            'value'     => $request['value'],
            'payDate'   => $request['payDate'],
        ]);
        $invoice->save();

        // update app payments
        $date = explode('-',  $request['date']);

        $payments = DB::table('payments')
        ->where([['payments.active', 1], ['payments.client_id', $request['clientId']]])
        ->whereYear('payments.date', '=', $date[0])
        ->whereMonth('payments.date', '=', $date[1])
        ->update(['invoice_id' => $invoice->id]);

        return $invoice;
    }


    public function update(Request $request, invoice $invoice)
    {
        //
    }

    public function destroy(invoice $invoice)
    {
        //
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
