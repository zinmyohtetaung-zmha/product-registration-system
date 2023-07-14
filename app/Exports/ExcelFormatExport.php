<?php

namespace App\Exports;

use App\Model\Category;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelFormatExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    /**
     * get Category from categories DB for exprot export
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param
     * @return
     */
    public function collection()
    {
        return Category::all();
    }
}
