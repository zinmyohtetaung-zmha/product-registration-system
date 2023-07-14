<?php

namespace App\DBTransactions\Category;

use App\Model\Category;
use App\Classes\DBTransaction;


/**
 * Delete category to category DB
 * @author ZinMyoHtetAung
 * @create 06/23/2023
 * @param
 * @return
 */
class DeleteCategory extends DBTransaction
{
    private $id;

    /**
     * Constructor to assign interface to variable
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Delete category from catories
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return void
     */
    public function process()
    {
        $query = Category::find($this->id);
        $query->delete();

        if (!$query) {
            return ['status' => false, 'error' => 404];
        }
        return ['status' => true, 'error' => ""];
    }
}
