<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsRequest;
use App\Models\Clients;
use App\Services\ClientServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    public function __construct(private ClientServices $service) {
    }
    
    public function clients() 
    {
        try {
            $result = $this->service->listClients();

            return response()->json(["message" => $result]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function clientById(int $id)
    {

    }

    public function postClient(ClientsRequest $request) 
    {
        try {
            $this->service->postClient($request->names, $request->gender, $request->phonenumber, $request->nid, $request->salary, $request->commitment, $request->district, $request->sector, $request->company, $request->position);

            return response()->json(["message" => "Successfully registered clients "]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateClient(int $id)
    {

    }

    
}
