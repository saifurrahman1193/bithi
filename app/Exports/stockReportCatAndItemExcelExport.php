<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class stockReportCatAndItemExcelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('stockreport_view')
				        ->select('category', 'itemName', 'itemCode', 'itemDescription', 'inStock', 'totalPrice')
				        ->get();
    }


    public function headings(): array
    {
        return [
	           'Category'  ,
               'Item',
               'Item Code',
               'Description',
               'Total Stock',
               'Total Price',
        ];
    }

}




