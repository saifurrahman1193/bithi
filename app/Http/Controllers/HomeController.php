<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dash_bill_sum_thisMBill_v_tReceiAmnt = DB::table('dash_bill_sum_thismonthbill_view')->sum('totalReceivableAmount');

        $dash_bill_sum_pendbill_v_tReceiAmnt = DB::table('dash_bill_sum_pendingbill_view')->sum('totalReceivableAmount');

        $highest_sold = DB::table('dash_highestlowestsolditems_view')->orderBy('totalPrice', 'desc')->take(20)->get();

        $dash_lowest_sold = DB::table('dash_highestlowestsolditems_view')->orderBy('totalPrice', 'asc')->take(20)->get();

        // if (Cache::has('dash_lowest_sold'))
        // {
        //     Cache::get('dash_lowest_sold');
        // }
        // else 
        // {
        //     $dash_lowest_sold = DB::table('dash_highestlowestsolditems_view')->orderBy('totalPrice', 'asc')->take(5)->get();
        //     Cache::put('dash_lowest_sold', $dash_lowest_sold);
            
        // }
        $todayPurchase = DB::table('purchase_view')->select('itemId', 'itemName')->where('created_at','LIKE',  todayDate().'%' )->distinct()->get();
        $todayPurchaseAmount = DB::table('inventory')->where('created_at','LIKE',  todayDate().'%' )->sum('totalPrice');

        $todaySale = DB::table('billlistsummarydetails_view')->select('itemId', 'itemName')->where('bill_created_at','LIKE',  todayDate().'%' )->distinct()->get();
        $todaySaleAmount = DB::table('billlistsummary_view')->where('invoiceDate','LIKE',  YmdTodmY(todayDate()).'%' )->sum('totalReceivableAmount');
        $todayTransactionAmount = DB::table('billlistsummary_view')->where('invoiceDate','LIKE',  YmdTodmY(todayDate()).'%' )->sum('transactionAmount');
        $todayDueAmount = DB::table('billlistsummary_view')->where('invoiceDate','LIKE',  YmdTodmY(todayDate()).'%' )->sum('due');
        
        
        return view('dashboard', compact('dash_bill_sum_thisMBill_v_tReceiAmnt', 'dash_bill_sum_pendbill_v_tReceiAmnt', 'highest_sold', 'dash_lowest_sold', 'todaySale', 'todayPurchase', 'todayPurchaseAmount', 'todaySaleAmount', 'todayTransactionAmount', 'todayDueAmount'));
    }


    public function admindashdisplay()
    {
        $dash_bill_sum_thisMBill_v_tReceiAmnt = DB::table('dash_bill_sum_thismonthbill_view')->sum('totalReceivableAmount');

        $dash_bill_sum_pendbill_v_tReceiAmnt = DB::table('dash_bill_sum_pendingbill_view')->sum('totalReceivableAmount');

        $highest_sold = DB::table('dash_highestlowestsolditems_view')->orderBy('totalPrice', 'desc')->take(20)->get();

        $dash_lowest_sold = DB::table('dash_highestlowestsolditems_view')->orderBy('totalPrice', 'asc')->take(20)->get();
        $todayPurchase = DB::table('purchase_view')->select('itemId', 'itemName')->where('created_at','LIKE',  todayDate().'%' )->distinct()->get();
        $todayPurchaseAmount = DB::table('inventory')->where('created_at','LIKE',  todayDate().'%' )->sum('totalPrice');

        $todaySale = DB::table('billlistsummarydetails_view')->select('itemId', 'itemName')->where('bill_created_at','LIKE',  todayDate().'%' )->distinct()->get();
        $todaySaleAmount = DB::table('billlistsummary_view')->where('created_at','LIKE',  todayDate().'%' )->sum('totalReceivableAmount');
        $todayTransactionAmount = DB::table('billlistsummary_view')->where('created_at','LIKE',  todayDate().'%' )->sum('transactionAmount');
        $todayDueAmount = DB::table('billlistsummary_view')->where('created_at','LIKE',  todayDate().'%' )->sum('due');
        
        return view('superadmin.dashboard', compact('dash_bill_sum_thisMBill_v_tReceiAmnt', 'dash_bill_sum_pendbill_v_tReceiAmnt', 'highest_sold', 'dash_lowest_sold', 'todaySale', 'todayPurchase', 'todayPurchaseAmount', 'todaySaleAmount', 'todayTransactionAmount', 'todayDueAmount'));
    }


    public function lowStockReport()
    {
        $listData = DB::table('stockreport_view')->get();
        return datatables()->of($listData)->make(true);
    }



}
