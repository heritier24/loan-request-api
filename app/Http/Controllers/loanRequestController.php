<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Services\LoanRequestServices;

class loanRequestController extends Controller
{
    public function __construct(private LoanRequestServices $service) {
    }

    public function getLoansRequest()
    {
        try {
            $result = $this->service->listLoanRequest();

            return response()->json(["message" => $result]);

        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function postLoansRequest(CreateLoanRequest $request) 
    {
        try {
            
            $this->service->postLoansRequest($request->clientID, $request->itemID, $request->note);

            return response()->json(["message" => "Loan Request Successfully created" ]);

        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateLoansRequest(UpdateLoanRequest $request, int $id)
    {
        try {
            $this->service->updateLoansRequest($request->status, $id);

            return response()->json(["message" => "Loans Request Successfully updated" ]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function getCountRequestStatistics()
    {
        try {
            
            $countClients = $this->service->countClientRequest();

            $countPending = $this->service->countPendingRequest();

            $countConfirmed = $this->service->countConfirmedRequest();

            $countDeclined = $this->service->countDeclinedRequest();

            return response()->json([
                "countClients" => $countClients,
                "countPending" => $countPending,
                "countconfirmed" => $countConfirmed,
                "countDeclined" => $countDeclined,
            ]);

        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
}
