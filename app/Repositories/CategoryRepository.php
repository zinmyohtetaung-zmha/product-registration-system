<?php

namespace App\Repositories;

use App\Model\Category;
use App\Interfaces\CategoryInterface;


/**
 * Category repository class
 * @author ZinMyoHtetAung
 * @create 06/23/2023
 * @param 
 * @return
 */
class CategoryRepository implements CategoryInterface
{

    /**
     * get all categories from categories DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return object
     */
    public function getAllCategories()
    {
        return Category::all();
    }


    /**
     * get category for categories DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return object
     */
    public function getCategoryById($id)
    {
        return Category::find($id);
    }
}
