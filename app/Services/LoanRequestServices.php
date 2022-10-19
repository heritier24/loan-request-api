<?php

namespace App\Services;

use App\Exceptions\ItemNotFoundException;
use App\Models\Clients;
use App\Models\Items;
use App\Models\LoanRequest;
use Illuminate\Support\Facades\DB;

class LoanRequestServices 
{

    public function listLoanRequest(): array
    {
        $loanRequest = DB::select("SELECT loan_requests.id, clients.names, clients.gender, clients.phonenumber,
                                 clients.salary, clients.commitment, clients.amountAllowed,
                                 items.itemName, items.itemType, 
                                 loan_requests.status 
                                 FROM loan_requests
                                 INNER JOIN clients ON loan_requests.clientID = clients.id
                                 INNER JOIN items ON loan_requests.itemID = items.id");

        return $loanRequest;
    }

    public function postLoansRequest(int $clientID, int $itemID, string $note = null): LoanRequest
    {
        $this->validatePostLoanRequest($clientID, $itemID);

        return LoanRequest::create([
            "clientID" => $clientID,
            "itemID" => $itemID,
            "note" => $note,
            "status" => "Pending"
        ]);
    }

    public function updateLoansRequest(string $status, int $id):void
    {
        LoanRequest::where('id', $id)->update([
            "status" => $status,
        ]);
        
    }

    public function countClientRequest()
    {
        return DB::selectOne("SELECT COUNT(loan_requests.id) AS allClients
        FROM loan_requests");
    }

    public function countPendingRequest()
    {
        return DB::selectOne("SELECT COUNT(loan_requests.id) AS pendingClients 
        FROM loan_requests WHERE loan_requests.status = 'Pending' ");

    }

    public function countConfirmedRequest()
    {
        return DB::selectOne("SELECT COUNT(loan_requests.id) AS confirmedClients 
        FROM loan_requests WHERE loan_requests.status = 'Confirmed' ");
    }

    public function countDeclinedRequest()
    {
        return DB::selectOne("SELECT COUNT(loan_requests.id) AS declinedClients 
        FROM loan_requests WHERE loan_requests.status = 'Declined' ");
    }

    public function validatePostLoanRequest(int $clientID, int $itemID)
    {
        $client = Clients::find($clientID);
        if (is_null($client)) {
            return new ItemNotFoundException("Client ID '$clientID' not found");
        }

        $item = Items::find($itemID);
        if (is_null($item)) {
            return new ItemNotFoundException("Item ID '$itemID' not found'");
        }
    }
}