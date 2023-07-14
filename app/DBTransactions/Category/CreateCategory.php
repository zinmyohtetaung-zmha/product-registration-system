<?php

namespace App\DBTransactions\Category;

use App\Model\Category;
use App\Classes\DBTransaction;

/**
 * Create Items to items DB
 * @author ZinMyoHtetAung
 * @create 06/23/2023
 * @param $request
 * @return
 */
class CreateCategory extends DBTransaction
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
     * Add category to catoriges DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return void
     */

    public function process()
    {
        $request = $this->request;

        $category = new Category();
        $category->category_name = $request->input('categoryName');
        $category->save();


        if (!$category) return ['status' => false, 'error' => 'Failed!'];

        return ['status' => true, 'error' => ''];
    }
}
