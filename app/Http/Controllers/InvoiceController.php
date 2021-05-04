<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
    public function showInvoice(Request $request)
    {
        return Invoice::getInvoice($request);
    }
}
