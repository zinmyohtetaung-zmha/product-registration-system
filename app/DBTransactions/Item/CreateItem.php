<?php

namespace App\DBTransactions\Item;

use App\Model\Item;
use App\Classes\DBTransaction;
use Illuminate\Support\Facades\Log;

/**
 * Create Items to items DB
 * @author ZinMyoHtetAung
 * @create 06/22/2023
 * @param $request
 * @return
 */
class CreateItem extends DBTransaction
{
    private $request;

    /**
     * Constructor to assign interface to variable
     */
    public function __construct($request)
    {
        $this->request = $request;
    }


    /**
     * Store Items to items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return
     */
    public function process()
    {
        $request = $this->request;

        
        $item = new Item();
        $item->item_id = $request->item_id;
        $item->item_code = $request->item_code;
        $item->category_id = $request->input('selectbox');
        $item->item_name = $request->item_name;
        $item->safety_stock = $request->safety_stock;
        $item->received_date = $request->received_date;
        $item->description = $request->description;
        $item->save();
        Log::info($item);

        if (!$item) {
            return ['status' => false, 'error' => 'Failed!'];
        }


        return ['status' => true, 'error' => ''];
    }
}
