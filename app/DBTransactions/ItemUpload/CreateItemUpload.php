<?php

namespace App\DBTransactions\ItemUpload;

use App\Model\ItemsUpload;
use App\Classes\DBTransaction;

/**
 * Create ItemsUpload to items DB
 * @author ZinMyoHtetAung
 * @create 06/23/2023
 * @param $request, $id
 * @return
 */
class CreateItemUpload extends DBTransaction
{
    private $request, $id;

    /**
     * Constructor to assign interface to variable
     */
    public function __construct($request, $id)
    {
        $this->request = $request;
        $this->id = $id;
    }

    /**
     * Add Item upload to itemsUploads DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return void
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

        $image = new ItemsUpload();
        $image->item_id = $id;
        $image->file_path = $file_path;
        $image->file_type = $exten;
        $image->file_size = intval($file_size);
        $image->save();

        return ['status' => true, 'error' => ''];
    }
}
