<?php

namespace App\Http\Controllers;

use PDF;
use App\Model\Item;
use App\Model\ItemsUpload;
use Illuminate\Http\Request;
use App\Interfaces\ItemInterface;
use App\Exports\itemDownloadExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\CategoryInterface;
use App\DBTransactions\Item\CreateItem;
use App\DBTransactions\Item\DeleteItem;
use App\DBTransactions\Item\UpdateItem;
use App\Interfaces\ItemUploadInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ItemRegisterRequest;
use App\DBTransactions\ItemUpload\CreateItemUpload;
use App\DBTransactions\ItemUpload\UpdateItemUpload;
use Illuminate\Support\Facades\Log;

/**
 * Item Controller Class
 * @author ZinMyoHtetAung
 * @create 06/22/2023
 * @param
 * @return
 */
class ItemController extends Controller
{
    protected $itemInterface;
    protected $categoryInterface;
    protected $itemUploadInterface;

    /**
     * constructor for ItemInterface and CategoryInterface
     * @author ZinMyoHtetAung
     * @create 06/22/2023n
     */
    public function __construct(ItemInterface $itemInterface, CategoryInterface $categoryInterface, ItemUploadInterface $itemUploadInterface)
    {
        $this->itemInterface = $itemInterface;
        $this->categoryInterface = $categoryInterface;
        $this->itemUploadInterface = $itemUploadInterface;
    }

    /**
     * Get all items list from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return view
     */
    public function getItems()
    {
        try {
            $items = $this->itemInterface->getAllItems();
            $itemCount = $items->total();

            $categories = $this->categoryInterface->getAllCategories();


            return view('pages.itemlist', ['items' => $items, 'rowCount' => $itemCount, 'categories' => $categories]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Auto generated vlaue Item ID and get category name from categories DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return view
     */
    public function loadRegisterData()
    {
        $categories = $this->categoryInterface->getAllCategories();
        $deleteAbleCategoryId = $this->itemInterface->deleteAbleCategoryId();

        //auto generated value Item ID
        $id = Item::latest('id')->value('id');

        if (!$id) {
            $id = 0;
        }

        $itemId = $id + 10001;

        return view('pages.normal-register')->with(['categories' => $categories, 'itemId' => $itemId, 'latestId' => $id, 'deleteAbleCategory' => $deleteAbleCategoryId]);
    }

    /**
     * Store Items to items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param Request $request
     * @return view
     */
    public function store(ItemRegisterRequest $request)
    {
        try {

            $item = new CreateItem($request);
            $newItem = $item->executeProcess();

            if (!$newItem) {
                return redirect()->route('load.register')->withErrors(['message' => 'Fail to save item.']);
            }

            if ($request->hasFile('filename')) {
                $id = Item::latest('id')->first()->id;
                $itemUpload = new CreateItemUpload($request, $id);
                $newItemUpload = $itemUpload->executeProcess();

                if (!$newItemUpload) {
                    return redirect()->route('load.register')->withErrors(['message' => 'Fail to save item upload.']);
                }
            }

            return redirect()->route('item.lists')->with('success', 'Item register Successfully!');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * delte items from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param Request $request
     * @return view
     */
    public function deleteItem(Request $request)
    {

        $paginationPage = $request->input('paginationPage');
        $perPage = $request->input('perpage');
        $totalRow = $request->input('totalrow');

        $item = new DeleteItem($request, $this->itemInterface);

        $deleteItem = $item->executeProcess();

        if (!$deleteItem) {
            return redirect()->back()->withErrors(['message' => 'Something went worng!.']);
        }

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }

    /**
     * Get items to detail from items DB
     * @author ZinMyoHtetAung
     * @create 06/22/2023
     * @param
     * @return view
     */
    public function getItemDetail($id)
    {

        $items = $this->itemInterface->getItemDetail($id);

        if (!$items) {
            return redirect()->back()->withErrors(['message' => 'This item is not found!.']);
        }

        return view('pages.itemDetail', ['items' => $items]);
    }

    /**
     * Get items to detail from items DB
     * @author ZinMyoHtetAung
     * @create 07/03/2023
     * @param
     * @return view
     */
    public function editItem($id)
    {
        $items = $this->itemInterface->getItemDetail($id);

        if ($items) {
            if ($items['deleted_at'] === null) {
                $categories = $this->categoryInterface->getAllCategories();
                $deleteAbleCategory = $this->itemInterface->deleteAbleCategoryId();

                return view('pages.update-form', ['items' => $items, 'categories' => $categories, 'deleteAbleCategory' => $deleteAbleCategory]);
            } else {

                return redirect()->route('item.lists')->withErrors(['message' => 'This item is inactive!.']);
            }
        } else {
            return redirect()->back()->withErrors(['message' => 'Item not found!.']);
        }
    }

    /**
     * Get items to detail from items DB
     * @author ZinMyoHtetAung
     * @create 07/03/2023
     * @param
     * @return view
     */
    public function updateItem(ItemRegisterRequest $request, $id)
    {

        $updateItem = $this->itemInterface->findId($id);

        if ($updateItem) {
            if ($updateItem['deleted_at'] === null) {
                $item = new UpdateItem($request, $id, $this->itemInterface);
                $updateItem = $item->executeProcess();

                if (!$updateItem) {
                    return redirect()->route('edit.item', ['id' => $id])->withErrors(['message' => 'Fail to upadte item.']);
                }

                // input file is has????
                if ($request->hasFile('filename')) {

                    $exitItemID = $this->itemUploadInterface->itemIdExitItemUpload($id);

                    //itemupload new or update
                    if ($exitItemID) {

                        $updateIntemUpload = new UpdateItemUpload($request, $id);
                        $updatedImage = $updateIntemUpload->executeProcess();

                        if (!$updatedImage) {
                            return redirect()->route('edit.item', ['id' => $id])->withErrors(['message' => 'Fail to upadte item upload.']);
                        }
                    } else {

                        $itemUpload = new CreateItemUpload($request, $id);
                        $newItemUpload = $itemUpload->executeProcess();

                        if (!$newItemUpload) {
                            return redirect()->route('edit.item', ['id' => $id])->withErrors(['message' => 'Fail to save item upload.']);
                        }
                    }
                } else {
                    if ($request->imageHidden == 'true') {

                        $fileDelete = ItemsUpload::where('item_id', '=', $request->id);
                        $imageDelete = ItemsUpload::where('item_id', '=', $request->id)->get();

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

                            if (!$fileDelete) {
                                return ['status' => false, 'error' => 'Failed!'];
                            }
                        }
                    }
                }

                return redirect(Session::get('requestReferrer'))->with('success', 'Item Updated successfully!');
            } else {
                return redirect(Session::get('requestReferrer'))->withErrors(['message' => 'Fail to update because this item is inactive!.']);
            }
        } else {
            return redirect(Session::get('requestReferrer'))->withErrors(['message' => 'Item not found!.']);
        }
    }

    /**
     * get item code and item name from
     * @author ZinMyoHtetAung
     * @create 06/26/2023
     * @param Request $request, $item-code
     * @return view
     */

    public function fetch(Request $request)
    {
        $itemId = $request->input('item_id');

        $item = $this->itemInterface->getItemByItemId($itemId);

        if ($item) {
            return response()->json([
                'success' => true,
                'data' => [
                    'item_name' => $item->item_name,
                    'item_code' => $item->item_code,
                    'category_id' => $item->category_id,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
            ]);
        }
    }

    /**
     * search items item_id, itemcode, itemname
     * @author ZinMyoHtetAung
     * @create 06/26/2023
     * @param Request $request, $item-code
     * @return view
     */

    public function search(Request $request)
    {
        $itemId = $request->input('itemId');
        $itemCode = $request->input('itemCode');
        $itemName = $request->input('itemName');
        $category = $request->input('category');
        $page = $request->input("page");

        $type = $request->input('search');

        //searching item show
        if ($type == 'search') {

            $items = $this->itemInterface->getSearchItems($request);

            $categories = $this->categoryInterface->getAllCategories();
            $rowCount = $items->total();

            if ($items->isEmpty()) {
                return view('pages.itemlist', compact('items', 'categories', 'rowCount'));
            }
            return view('pages.itemlist', compact('items', 'categories', 'rowCount'));
        }

        //searcing tiem pdf download
        if ($type == 'pdf') {

            if ($itemId == "" && $itemCode == "" && $itemName == "" && $category == "") {
                $items = $this->itemInterface->getAllItemsDown();
            } else {
                $items = $this->itemInterface->getSearchItems($request);
            }

            // Generate PDF
            $pdf = PDF::loadView('pages.pdfdown', compact('items'));

            // Download the PDF
            return $pdf->download('itemsList.pdf');
        }

        //searcing tiem excel download
        if ($type == 'excel') {

            if ($itemId == "" && $itemCode == "" && $itemName == "" && $category == "") {
                $items = $this->itemInterface->getAllItemsDown();
            } else {
                $items = $this->itemInterface->getSearchItems($request);
            }
            return Excel::download(new ItemDownloadExport($items), 'itemsList.xlsx');
        }
    }

    /**
     * update delte-at in items DB for active change
     * @author ZinMyoHtetAung
     * @create 06/28/2023
     * @param $rowValue
     * @return view
     */
    public function daletedAtUpdate(Request $request)
    {
        $item = $this->itemInterface->getItemById($request->input('selctValue'));

        if ($item) {
            if ($item['deleted_at'] === null) {
                $item->deleted_at = date(now());
                $item->save();

                session()->flash('success', 'Item inactive successfully.');
                return response()->json([
                    'success' => true,
                ]);
            } else {
                session()->flash('error', 'This item is already inactive!');
                return response()->json([
                    'success' => false,
                ]);
            }
        } else {
            session()->flash('error', 'Item is not found!');
            return response()->json([
                'success' => null,
            ]);
        }
    }

    /**
     * update delte-at null in items DB for inactive change
     * @author ZinMyoHtetAung
     * @create 06/30/2023
     * @param $rowValue
     * @return view
     */
    public function daletedAtNullUpdate($rowValue)
    {
        $item = $this->itemInterface->getItemById($rowValue);

        if ($item) {
            if ($item['deleted_at'] !== null) {
                $item->deleted_at = null;
                $item->save();

                session()->flash('success', 'Item active successfully.');
                return response()->json([
                    'success' => true,
                ]);
            } else {
                session()->flash('error', 'This item is already active!');
                return response()->json([
                    'success' => false,
                ]);
            }
        } else {
            session()->flash('error', 'Item is not found!');
            return response()->json([
                'success' => null,
            ]);
        }
    }

    /**
     * autocomplete item_id in search item_id input
     * @author ZinMyoHtetAung
     * @create 12/07/2023
     * @param $request
     * @return json data
     */
    public function autocomplete(Request $request)
    {
        $term = $request->term;

        $itemid = Item::where('item_id', 'LIKE', '%' . $term . '%')->get(['item_id']);

        return response()->json($itemid);
    }
}
