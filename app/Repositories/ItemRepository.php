<?php

namespace App\Repositories;

use App\Model\Item;
use App\Model\Category;
use App\Model\ItemsUpload;
use App\Interfaces\ItemInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Item repository class
 * @author ZinMyoHtetAung
 * @create 06/23/2023
 * @param 
 * @return
 */
class ItemRepository implements ItemInterface
{

    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getAllItems($perPage = 20)
    {
        $itemList = Item::join('categories', 'categories.id', 'items.category_id')
            ->select('items.id', 'items.item_id', 'items.item_code', 'items.item_name', 'items.safety_stock', 'items.received_date', 'items.description', 'items.deleted_at', 'categories.category_name')
            ->orderByDesc('items.created_at')
            ->paginate($perPage);

        return $itemList;
    }


    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getAllItemsDown()
    {
        $itemList = Item::join('categories', 'categories.id', 'items.category_id')
            ->select('items.*', 'categories.category_name')
            ->orderByDesc('items.created_at');


        $items = $itemList->get();
        return $items;
    }


    /**
     * Get items with ID from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getItemById($id)
    {
        return Item::find($id);
    }

    /**
     * Get items with item_id from items DB
     * @author ZinMyoHtetAung
     * @create 06/30/2023
     * @param
     * @return array
     */
    public function getItemByItemId($itemId)
    {
        return Item::where('item_id', '=', $itemId)->first();
    }

    /**
     * Get categorie where items table in null
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function deleteAbleCategoryId()
    {

        $itemCategoryId = Category::leftJoin('items', 'items.category_id', 'categories.id')
            ->whereNull('items.category_id')
            ->select('categories.id', 'categories.category_name')->get();
        return $itemCategoryId;
    }


    /**
     *Find item with id in items DB
     * @author ZinMyoHtetAung
     * @create 07/03/2023
     * @param
     * @return array
     */
    public function findId($id)
    {

        $id = Item::find($id);
        return $id;
    }

    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getItemDetail($id)
    {
        $checkHasItemIdInUploadTb = ItemsUpload::where('item_id', 'like', $id)->select('item_id')->first();

        if ($checkHasItemIdInUploadTb) {
            $itemList = Item::join('categories', 'categories.id', 'items.category_id')
                ->join('items_uploads', 'items_uploads.item_id', 'items.id')
                ->select('items.*', 'categories.category_name', 'items_uploads.file_path')
                ->find($id);
        } else {

            $defImg = 'uploadfile/default.png';

            $itemList = Item::join('categories', 'categories.id', 'items.category_id')
                ->select('items.*', 'categories.category_name', DB::raw("'{$defImg}' as file_path"))
                ->find($id);
        }

        return ($itemList);
    }


    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getSearchItems($request, $perPage = 2)
    {
        $itemId = $request->input('itemId');
        $itemCode = $request->input('itemCode');
        $itemName = $request->input('itemName');
        $category = $request->input('category');
        $type = $request->input('search');

        $query = Item::join('categories', 'categories.id', '=', 'items.category_id')
            ->select('items.*', 'categories.category_name')
            ->orderBy('items.created_at', 'desc');

        if (!empty($itemId)) {
            $query->where('items.item_id', 'LIKE', '%' . $itemId . '%');
        }

        if (!empty($itemCode)) {
            $query->where('items.item_code', 'LIKE', '%' . $itemCode . '%');
        }

        if (!empty($itemName)) {
            $query->where('items.item_name', 'LIKE', '%' . $itemName . '%');
        }

        if (!empty($category)) {
            $query->where('items.category_id', '=', $category);
        }

        if ($type == 'pdf' || $type == 'excel') {
            $items = $query->get();
            return $items;
        }

        $items = $query->paginate($perPage)->appends(request()->except('page'));
        $Allitems = $query->get();


        return $items;

    }
}
