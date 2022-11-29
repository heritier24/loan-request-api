<?php

namespace App\Services;

use App\Models\Items;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemsServices
{
    public function listItems(): array
    {
        $items = DB::select("select items.id,items.itemName AS name,items.itemType,
                            items.itemDescription, items.itemImage
                            FROM items");

        return $items;
    }

    public function getItemByItemId(int $itemId)
    {
        return DB::select("SELECT items.id,items.itemName AS name,
                            items.itemType,
                            items.itemDescription, items.itemImage
                            FROM items WHERE items.id = ?", [$itemId]);
    }

    public function postItems(string $itemName, string $itemType, string $itemDescription, string $itemImage): Items
    {
        $path = Storage::putFile("items/image", $itemImage);
        return Items::create([
            "itemName" => $itemName,
            "itemType" => $itemType,
            "itemDescription" => $itemDescription,
            "itemImage" => $path
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
