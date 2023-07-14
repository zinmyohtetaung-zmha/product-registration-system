<?php

namespace App\Interfaces;

interface ItemInterface
{
    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getAllItems();


    /**
     * Get items with ID from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getItemById($id);


    /**
     * Get items with item_id from items DB
     * @author ZinMyoHtetAung
     * @create 06/30/2023
     * @param
     * @return array
     */
    public function getItemByItemId($itemId);


    /**
     * Get categorie where items table in null
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function deleteAbleCategoryId();

    /**
     * Find item with id
     * @author ZinMyoHtetAung
     * @create 07/03/2023
     * @param
     * @return 
     */
    public function findId($id);


    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getItemDetail($id);


    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getSearchItems($request);

    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return array
     */
    public function getAllItemsDown();
}
