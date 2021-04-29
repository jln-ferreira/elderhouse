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
}
