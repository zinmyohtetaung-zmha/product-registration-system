<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemExport implements FromCollection, WithTitle, WithEvents
{

    /**
     * export items registration sheet title
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param
     * @return
     */
    public function title(): string
    {
        return 'Items Registration';
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    /**
     * export items registration excel format
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param
     * @return
     */
    public function collection()
    {
        $title1 = "*Do not allow the fiel that the number of rows are greater than 100 rows";
        $title2 = "*Please look at the Category Name sheet and enter that id in the Category Name ID column.";

        $header = ['Item Code', 'Item Name', 'Category Name', 'Safety', 'Received Date', 'Description'];

        return collect([[$title1], [$title2], [$header]]);
    }


    /**
     * Excel export style for itmes registration sheet
     * @author ZinMyoHtetAung
     * @create 06/23/2023
     * @param
     * @return
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getDelegate()->mergeCells('A1:F1');
                $event->sheet->getDelegate()->mergeCells('A2:F2');
                $event->sheet->getDelegate()->getStyle('A1:F1')->getFont()->setSize(10)->getColor()->setARGB('B70404');
                $event->sheet->getDelegate()->getStyle('A2:F2')->getFont()->setSize(10)->getColor()->setARGB('B70404');

                $event->sheet->getDelegate()->getStyle('A3:F3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('A8D1D1');
                $event->sheet->getDelegate()->getStyle('A3:E3')->getFont()->setSize(12)->getColor()->setARGB('B70404');
                $event->sheet->getDelegate()->getStyle('A3:F3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A3:F3')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A3:F3')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('1A0000');

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
            },

        ];
    }
}
