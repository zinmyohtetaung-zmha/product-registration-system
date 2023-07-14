<?php

namespace App\DBTransactions\ItemUpload;

use App\Model\Item;
use App\Model\ItemsUpload;
use App\Classes\DBTransaction;
use App\Interfaces\ItemInterface;

/**
 * Update Items Upload to itemsUploads DB
 * @author ZinMyoHtetAung
 * @create 07/04/2023
 * @param $request, $id
 * @return
 */
class UpdateItemUpload extends DBTransaction
{

    private $request;
    private $id;

    /**
     * constructor for Request,ItemInterface
     * @author ZinMyoHtetAung
     * @create 07/03/2023n
     */
    public function __construct($request, $id)
    {
        $this->request = $request;
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

        $file_size = $request->filename->getSize();
        $imagefile = $request->filename;
        $exten = $imagefile->extension();
        $imageName = $request->item_id . '.' . $exten;
        $file_path = $imagefile->move('uploadfile', $imageName)->getPathname();

        $hasItemId = ItemsUpload::where('item_id', $id)->first();
        $hasItemId->item_id = $id;
        $hasItemId->file_path = $file_path;
        $hasItemId->file_type = $exten;
        $hasItemId->file_size = intval($file_size);
        $hasItemId->update(); // Use save() instead of update()


        return ['status' => true, 'error' => ''];
    }
}
