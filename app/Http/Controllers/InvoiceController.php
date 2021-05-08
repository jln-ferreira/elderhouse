<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return Invoice::getInvoices();
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
