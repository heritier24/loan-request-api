<?php

namespace App\Services;

use App\Models\Clients;
use Illuminate\Support\Facades\DB;

class ClientServices 
{

    public function listClients(): array
    {
        $clients = DB::select("select clients.names,clients.gender, 
                               clients.phonenumber, clients.nid, clients.salary, 
                               clients.commitment, 
                               clients.company, clients.position FROM clients ORDER BY clients.id DESC");

        return $clients;
    }

    public function postClient(string $names, string $gender, string $phonenumber, $nid, string $salary, string $commitment, string $district, string $sector, string $company, string $position): Clients
    {
        return Clients::create([
            "names" => $names,
            "gender" => $gender,
            "phonenumber" => $phonenumber,
            "nid" => $nid,
            "salary" => $salary,
            "commitment" => $commitment,
            "district" => $district,
            "sector" => $sector,
            "company" => $company,
            "position" => $position,
        ]);
    }
}