<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;


class profitAnalysisExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('profitanalysis_view')
				        ->select(DB::raw('DATE_FORMAT(invoiceDate, "%d-%m-%Y")'), 'itemCode', 'itemName', 'qty', 'buyingPrice', 'totalPrice','profit', 'supplierTitle')
				        ->get();

    }

    public function headings(): array
    {
        return [
	            'Date'  ,
               'Product Code',
               'Product Name',    
               'Qty'  ,
               'Buying Price',   
               'Selling Price',   
               'Profit'   ,
               'Supplier'   
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:N1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }

    

}




