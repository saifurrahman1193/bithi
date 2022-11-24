<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\Expenses;
use App\ExpenseTypes;

use App\Exports\profitAnalysisExport;
use App\Exports\payableDueExport;
use App\Exports\receivableDueExport;

use App\Exports\stockReportFullExport;
// use App\Exports\stockReportCatAndItemExcelExport;
use App\Exports\expensesExport;

use Excel;



class ReportController extends Controller
{

    // expense report=============
    public function expensesExcelReportDownload() 
    {
        return Excel::download(new expensesExport, 'expensesExport.xlsx');
    }


    // stock reports========================================
    public function stockReportFullExcelReportDownload() 
    {
        return Excel::download(new stockReportFullExport, 'stockReportFullExport.xlsx');
    }




    // receivable due ======================================
	public function receivableDue()
    {
        return view('reports/receivableDue');
    }
    public function receivableDueExcelReportDownload() 
    {
        return Excel::download(new receivableDueExport, 'receivableDueExport.xlsx');
    }



    // payable due ======================================
    public function payableDue()
    {
        return view('reports/payableDue');
    }
    public function payableDueExcelReportDownload() 
    {
        return Excel::download(new payableDueExport, 'payableDueExport.xlsx');
    }


    // profitAnalysis report=====================
    public function profitAnalysis()
    {
        return view('reports/profitAnalysis');
    }

    public function profitAnalysisExcelReportDownload() 
    {
        return Excel::download(new profitAnalysisExport, 'profitAnalysisExport.xlsx');
    }





}
