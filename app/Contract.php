<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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
            "contracts.user_id",
            "users.name AS user_name",
            "specifications.CPF",
            "specifications.RG",
            "contracts.family_id",
            "families.name AS families_name",
            "families.surname AS families_surname",
            "families.parent",
            "families.email AS families_email",
            "contracts.contract_url",
            "clients.appartament",
            "contracts.comments",
            "contracts.date"
        )
        ->leftJoin('clients', 'contracts.client_id', '=', 'clients.id')
        ->leftJoin('specifications', 'clients.id', '=', 'specifications.client_id')
        ->leftJoin('families', 'contracts.family_id', '=', 'families.id')
        ->leftJoin('users', 'contracts.user_id', '=', 'users.id')
        ->where([['contracts.active', 1],['specifications.active', 1], ['families.active', 1], ['contracts.client_id', $clientId]])
        ->get();
    }
}
