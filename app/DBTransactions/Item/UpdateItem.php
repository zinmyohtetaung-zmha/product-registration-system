<?php

namespace App\DBTransactions\Item;

use App\Classes\DBTransaction;
use App\Interfaces\ItemInterface;

/**
 * Update Items to items DB
 * @author ZinMyoHtetAung
 * @create 07/03/2023
 * @param $request
 * @return
 */
class UpdateItem extends DBTransaction
{

    private $request;
    private $itemInterface;
    private $id;

    /**
     * constructor for Request,ItemInterface
     * @author ZinMyoHtetAung
     * @create 07/03/2023n
     */
    public function __construct($request, $id, ItemInterface $itemInterface)
    {
        $this->request = $request;
        $this->itemInterface = $itemInterface;
        $this->id = $id;
    }

    /**
     * Update Items to items DB
     * @author ZinMyoHtetAung
     * @create 07/03/2023
     * @param
     * @return
     */
    public function process()
    {
        $request = $this->request;
        $id = $this->id;

        $updateItem = $this->itemInterface->findId($id);

        if ($updateItem) {

            $updateItem->item_id = $request->item_id;
            $updateItem->item_code = $request->item_code;
            $updateItem->category_id = $request->input('selectbox');
            $updateItem->item_name = $request->item_name;
            $updateItem->safety_stock = $request->safety_stock;
            $updateItem->received_date = $request->received_date;
            $updateItem->description = $request->description;
            $updateItem->update();

            if (!$updateItem) {
                return ['status' => false, 'error' => 'Failed!'];
            }

            return ['status' => true, 'error' => ''];
        }
    }
}
