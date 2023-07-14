<?php

namespace App\DBTransactions\Item;

use App\Classes\DBTransaction;
use App\Interfaces\ItemInterface;
use App\Model\ItemsUpload;

/**
 * Update Items to items DB
 * @author ZinMyoHtetAung
 * @create 07/03/2023
 * @param $request
 * @return
 */
class DeleteItem extends DBTransaction
{

    private $request;
    private $itemInterface;

    /**
     * constructor for Request,ItemInterface
     * @author ZinMyoHtetAung
     * @create 07/03/2023n
     */
    public function __construct($request, ItemInterface $itemInterface)
    {
        $this->request = $request;
        $this->itemInterface = $itemInterface;
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
        $id = $this->request->input('deleteInput');

        $delItem = $this->itemInterface->getItemById($id);

        if ($delItem && $delItem['deleted_at'] === null) {

            $fileDelete = ItemsUpload::where('item_id', '=', $delItem['id']);
            $imageDelete = ItemsUpload::where('item_id', '=', $delItem['id'])->get();

            if ($imageDelete->isNotEmpty()) {
                $firstItem = $imageDelete->first();
                $filePath = $firstItem->file_path;

                // Delete the photo file from folder  using unlink
                if (file_exists(public_path($filePath))) {
                    unlink(public_path($filePath));
                }

                //delete itemupload image from itemsUploads DB
                $fileDelete->delete();

                //delete item from items DB
                $delItem->delete();

                if (!$delItem) {
                    return ['status' => false, 'error' => 'Failed!'];
                }

            } else {

                //delete item from items DB
                $delItem->delete();
            }
        }else{
            return $delItem;
        }
        return ['status' => true, 'error' => ''];
    }
}
