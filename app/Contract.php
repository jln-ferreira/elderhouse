<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $guarded = [];


    public static function getFullContract($clientId)
    {
        return DB::table('contracts')
        ->select(
            "contracts.id",
            "contracts.client_id",
            "clients.name AS client_name",
            "clients.surname AS client_surname",
            "contracts.client_signature",
            "contracts.user_id",
            "users.name AS user_name",
            "contracts.user_signature",
            "specifications.CPF",
            "specifications.RG",
            "contracts.family_id",
            "families.name AS families_name",
            "families.surname AS families_surname",
            "families.parent",
            "families.email AS families_email",
            "contracts.families_signature",
            "clients.appartament"
            )
        ->leftJoin('clients', 'contracts.client_id', '=', 'client.id')
        ->leftJoin('specifications', 'clients.id', '=', 'specifications.client_id')
        ->leftJoin('families', 'diagnostic_clients.diagnostic_id', '=', 'diagnostics.id')
        ->where(['contracts.active', 1],['specifications.active', 1], ['families.responsable', 1], ['contracts.client_id', $clientId])
        ->get();
    }
}
