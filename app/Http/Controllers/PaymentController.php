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

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
