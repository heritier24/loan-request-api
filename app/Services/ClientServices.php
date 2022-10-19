<?php

namespace App\Services;

use App\Models\Clients;
use Illuminate\Support\Facades\DB;

class ClientServices 
{

    public function listClients(): array
    {
        $clients = DB::select("select clients.id,clients.names,clients.gender, 
                               clients.phonenumber, clients.nid, clients.salary, 
                               clients.commitment,clients.amountAllowed, 
                               clients.company, clients.position FROM clients ORDER BY clients.id DESC");

        return $clients;
    }

    public function postClient(string $names, string $gender, string $phonenumber, $nid, string $salary, string $commitment, $amountAllowed, string $district, string $sector, string $company, string $position): Clients
    {
        return Clients::create([
            "names" => $names,
            "gender" => $gender,
            "phonenumber" => $phonenumber,
            "nid" => $nid,
            "salary" => $salary,
            "commitment" => $commitment,
            "amountAllowed" => $amountAllowed,
            "district" => $district,
            "sector" => $sector,
            "company" => $company,
            "position" => $position,
        ]);
    }

    public function clientById(int $nid): array
    {
        $client = DB::select("SELECT * FROM Clients 
                               WHERE nid = ? ", [$nid]);

        return $client;
    }
}