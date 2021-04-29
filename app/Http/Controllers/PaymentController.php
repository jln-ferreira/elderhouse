<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        return Payment::activePayments();
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'clientId'        => ['required', 'numeric'],
            'precificationId' => ['required', 'numeric'],
            'value'           => ['required', 'min:1'],
            'date'            => ['required', 'date'],
            'comment'         => ['max:100'],
        ])->validate();

        // Payment
        $payment = Payment::Create([
            'client_id'        => $request['clientId'],
            'precification_id' => $request['precificationId'],
            'value'            => $request['value'],
            'date'             => $request['date'],
            'comment'          => $request['comment'],
        ]);
        $payment->save();

        return Payment::activePayment($payment->id);
    }


    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'clientId'        => ['required', 'numeric'],
            'precificationId' => ['required', 'numeric'],
            'value'           => ['required', 'min:1'],
            'date'            => ['required', 'date'],
            'comment'         => ['max:100'],
        ])->validate();



        // // modify payments
        $payment = Payment::find($request['id']);
        $payment->client_id        = $request['clientId'];
        $payment->precification_id = $request['precificationId'];
        $payment->value            = $request['value'];
        $payment->date             = $request['date'];
        $payment->comment          = $request['comment'];
        $payment->save();

        return $payment;
    }


    public function destroy($paymentId)
    {
        $payment = Payment::find($paymentId);
        $payment->active = 0;
        $payment->save();

        return $payment;
    }


    public function getPaymentDates($clientId)
    {
        return Payment::getPaymentDates($clientId);
    }
}
