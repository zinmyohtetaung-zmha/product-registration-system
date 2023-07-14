<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MultipleSheetExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemRegistationImport;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ExcelRegisterRequest;

/**
 * Excel Controller Class
 * @author ZinMyoHtetAung
 * @create 06/22/2023
 * @param
 * @return 
 */
class ExcelController extends Controller
{
    /**
     * Excel format download 
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return void
     */
    public function export()
    {
        return Excel::download(new MultipleSheetExport, 'itemsList.xlsx');
    }

    /**
     * Items excel import to items DB
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param 
     * @return void
     */
    public function import(ExcelRegisterRequest $request)
    {
     

        $file = $request->file('file');    
        try {
            Excel::import(new ItemRegistationImport, $file);

            return redirect()->route('item.lists')->with('success', 'Suceess Items Registration with excel file.');
        } catch (\Exception $e) {
            // Log::info($e->getMessage());

            return redirect()->route('load.register')->with(['message' => $e->getMessage()]);
        }
    }
}
