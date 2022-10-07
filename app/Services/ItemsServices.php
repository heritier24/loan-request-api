<?php

namespace App\Services;

use App\Models\Items;
use Illuminate\Support\Facades\DB;

class ItemsServices
{
    public function listItems(): array
    {
        $items = DB::select("select items.itemName,items.itemType,
                            items.itemDescription, items.itemImage
                            FROM items");

        return $items;

    }

    public function postItems(string $itemName, string $itemType, string $itemDescription, string $itemImage = null): Items
    {
        return Items::create([
            "itemName" => $itemName,
            "itemType" => $itemType,
            "itemDescription" => $itemDescription,
            "itemImage" => $itemImage
        ]);
    }

    public function updateItems(string $itemName, string $itemType, string $itemDescription, string $itemImage = null, int $id)
    {
        $updateItem = Items::find($id);
        $updateItem->update([
            "itemName" => $itemName,
            "itemType" => $itemType,
            "itemDescription" => $itemDescription,
            "itemImage" => $itemImage
        ]);

        return $updateItem;
    }
}