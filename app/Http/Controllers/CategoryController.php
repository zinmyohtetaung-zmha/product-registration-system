<?php

namespace App\Http\Controllers;

use App\DBTransactions\Category\CreateCategory;
use App\DBTransactions\Category\DeleteCategory;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Category Controller Class
 * @author ZinMyoHtetAung
 * @create 06/22/2023
 * @param
 * @return
 */
class CategoryController extends Controller
{

    protected $categoryInterface;

    /**
     * Constructor to assign interface to variable
     */
    public function __construct(CategoryInterface $categoryInterface)
    {
        // $this->itemInterface = $itemInterface;
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * store category to categories DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param Request $request
     * @return void
     */
    public function storeCategory(Request $request)
    {
        try {
            // return response()->json('I am');

            $category = new CreateCategory($request);
            $newCategory = $category->executeProcess();

            $categories = $this->categoryInterface->getAllCategories();
       
            return $categories;
            
        }  catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * delete category to categories DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param Request $request
     * @return void
     */
    public function deleteCategory(Request $request)
    {
        //Log::inrfo($request);
        try {

            $select = $request->input('selectedValue');

            $category = new DeleteCategory($select);
            $delt3eCategory = $category->executeProcess();

            session()->flash('success', 'Remove category successfully.');

            return response()->json([
                'success' => true,
            ]);
            

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
