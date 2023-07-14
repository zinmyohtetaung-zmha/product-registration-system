<?php

namespace App\Exports;

use App\Model\Category;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoryExport implements FromCollection, WithTitle, WithEvents
{
    public function title(): string
    {
        return 'Category Name';
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    /**
     * Category table export excel
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param
     * @return
     */
    public function collection()
    {
        $title = "Category Name List";
        $header = ['ID', 'Category Name'];

        $query = Category::select('id', 'category_name')->orderBy("id")->get();


        return collect([[$title], [$header]])->concat($query);
    }


    /**
     * Excel export style for category name sheet
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param
     * @return
     */
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getDelegate()->mergeCells('A1:B1');
                $event->sheet->getDelegate()->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('A8D1D1');
                $event->sheet->getDelegate()->getStyle('A1:B1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('1A0000');
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setSize(15)->getColor()->setARGB('1A0000');

                $event->sheet->getDelegate()->getStyle('A2:B2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('A8D1D1');
                $event->sheet->getDelegate()->getStyle('A2:B2')->getFont()->setSize(12)->getColor()->setARGB('1A0000');
                $event->sheet->getDelegate()->getStyle('A2:B2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A2:B2')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:B2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('1A0000');
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);

                $categories = count(Category::all());

                for ($i = 3; $i < $categories + 3; $i++) {
                    $event->sheet->getDelegate()->getStyle(('A' . $i . ':B' . $i))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('EEEEEE');
                    $event->sheet->getDelegate()->getStyle(('A' . $i . ':B' . $i))->getFont()->setSize(12)->getColor()->setARGB('1A0000');
                    $event->sheet->getDelegate()->getStyle(('A' . $i . ':B' . $i))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $event->sheet->getDelegate()->getStyle(('A' . $i . ':B' . $i))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('1A0000');
                }
            },

        ];
    }
}
