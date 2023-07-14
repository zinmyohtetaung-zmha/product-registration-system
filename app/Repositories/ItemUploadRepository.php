<?php

namespace App\Repositories;

use App\Model\ItemsUpload;
use App\Interfaces\ItemUploadInterface;

/**
 * Item upload repository class
 * @author ZinMyoHtetAung
 * @create 06/23/2023
 * @param 
 * @return
 */
class ItemUploadRepository implements ItemUploadInterface
{

    /**
     * get all itemupload from itemuploads DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return object
     */
    public function getAllItemUpload()
    {
        return ItemsUpload::all();
    }


    /**
     * get category with ID for itemuploads DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return object
     */
    public function getItemUploadById($id)
    {
        return ItemsUpload::find($id);
    }


    /**
     * find item_id in itemuploads DB
     * @author ZinMyoHtetAung
     * @create 07/04/2023
     * @param 
     * @return object
     */
    public function itemIdExitItemUpload($item_id)
    {
        return ItemsUpload::where('item_id', $item_id)->first();
    }
}
