<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemsRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemsServices;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct(private ItemsServices $service) {
    }
    
    public function listItems()
    {
        try {
            $result = $this->service->listItems();

            return response()->json(["message" => $result]);
        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function postItem(ItemsRequest $request)
    {
        try {
            $this->service->postItems($request->itemName, $request->itemType, $request->itemDescription, $request->itemImage);

            return response()->json(["message" => "successfull item created"]);

        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }

    public function updateItem(UpdateItemRequest $request, int $id)
    {
        try {
            $this->service->updateItems($request->itemName, $request->itemType, $request->itemDescription, $request->itemImage, $id);

            return response()->json(["message" => "successfull item updated"]);

        } catch (\Exception $e) {
            [$message, $statusCode, $exceptionCode] = getHttpMessageAndStatusCodeFromException($e);

            return response()->json([
                "message" => $message,
            ], $statusCode);
        }
    }
    public function deleteItem(int $id) 
    {

    }

    
}
