<?php

namespace App\Imports;

use App\Model\Category;
use App\Model\Item;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Validation\ValidationException;


class FirstSheetImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $dataRows = $rows->slice(3); // Exclude the first row (header row)            


        if ($dataRows->isEmpty()) {
            throw new \Exception("No records found!");
        }

        if ($dataRows->count() > 100) {
            throw new \Exception("The maximum limit of 100 rows has been reached!");
        }


        foreach ($dataRows as $index => $row) {

            $rowArray = $row->toArray(); // Convert object to array

            $validator = Validator::make($rowArray, [
                '0' => 'required',
                '1' => 'required',
                '2' => 'required|exists:categories,id',
                '3' => 'required|numeric',
                '4' => 'required|numeric',

            ]);

            $customMessages = [
                '0.required' => 'Item Code is required!.',
                '1.required' => 'Item Name is required!.',
                '2.required' => 'Category name is required!.',
                '2.exists' => 'The selected Category ID is invalid!.',
                '3.required' => 'Safety Stock is required!.',
                '3.numeric' => 'Safety Stock must be integer!.',
                '4.required' => 'Received Date is required!.',
                '4.numeric' => 'Received Date must be date!.',



            ];

            $validator->setCustomMessages($customMessages);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                // Log::info($errors);

                $rowNumber = $index + 1; // Adjust row number to account for header row
                $errorMessage = 'Row ' . $rowNumber . ': ' . implode(', ', $errors);
                throw new \Exception($errorMessage);
            }

            // $category = Category::where('category_name', $row[2])->first();
            // $categoryIdValue = $category->id;

            $id = Item::latest('id')->value('id');
            if (!$id) {
                $id = 0;
            }
            $itemId = $id + 10001;

            $newItem = new Item();
            $newItem->item_id = $itemId;
            $newItem->item_code = $row[0];
            $newItem->item_name = $row[1];
            $newItem->category_id = $row[2];
            $newItem->safety_stock = $row[3];
            $newItem->received_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d');
            $newItem->description = $row[5];

            $newItem->save();
        }
    }

}
