<?php

namespace App\Interfaces;

interface ItemUploadInterface
{

    /**
     * Get all itemsUpload list from itemsUploads DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getAllItemUpload();


    /**
     * Get item with ID from itemsUploads DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getItemUploadById($id);



    /**
     * find item_id from itemsUploads DB
     * @author ZinMyoHtetAung
     * @create 07/04/2023
     * @param
     * @return array
     */
    public function itemIdExitItemUpload($item_id);
}
