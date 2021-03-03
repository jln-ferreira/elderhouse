<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $guarded = [];


    public static function activeDiagnostics()
    {
        return DB::table('diagnostic_clients')
        ->select("diagnostic_clients.id", "diagnostic_clients.client_id", "diagnostic_clients.diagnostic_id", "diagnostics.name", "diagnostic_clients.client_id", "diagnostics.rank", "diagnostic_clients.date", "diagnostic_clients.comments")
        ->leftJoin('diagnostics', 'diagnostic_clients.diagnostic_id', '=', 'diagnostics.id')
        ->where(['diagnostic_clients.active', 1])
        ->get();
    }

    public static function getDiagnostics($id)
    {
        return DB::table('diagnostic_clients')
        ->select("diagnostic_clients.id","diagnostic_clients.client_id", "diagnostic_clients.diagnostic_id", "diagnostics.name", "diagnostic_clients.client_id", "diagnostics.rank", "diagnostic_clients.date", "diagnostic_clients.comments")
        ->leftJoin('diagnostics', 'diagnostic_clients.diagnostic_id', '=', 'diagnostics.id')
        ->where([['diagnostic_clients.active', 1], ['diagnostic_clients.id', $id]])
        ->get();
    }
}
