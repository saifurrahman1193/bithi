<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;


use App\Customers;
use App\Item;

use App\BillCalls;
use App\QCStatus;
use App\DeliveryStatus;
use App\PaymentStatus;
use App\PmntMethodType;
use App\Transactions;





use App\Bills;
use App\BillDetails;


use PDF;


use src\NTWIndia;
use src\Exception\NTWIndiaInvalidNumber;
use src\Exception\NTWIndiaNumberOverflow;





class BillingController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    

    // bills=======================================

    public function bills()
    {

        $customers = Customers::get();
        $items = DB::table('item_inventory_billdtls_view')->get();

        $billcalls = BillCalls::select('billCall','billCallId' )->get();
        $qcstatus = QCStatus::select('qcStatusId','qcStatus' )->get();
        $deliverystatus = DeliveryStatus::select('deliveryStatus','deliveryStatusId' )->get();
        $paymentstatus = PaymentStatus::select('paymentStatus','paymentStatusId' )->get();
        $pmntmethodtype = PmntMethodType::select('pmntMethodType','pmntMethodTypeId' )->get();


        return view('billing/billCreate', compact('customers', 'items', 'billcalls','qcstatus', 'deliverystatus', 'paymentstatus', 'pmntmethodtype'));
    }



    public function billCreateGetSuppliersAgainstItem($itemId) 
    {
        $suppliers = DB::table("billcreateinvsupplier_view")->where("itemId",$itemId)->pluck("supplierTitle", "supplierId");
        return json_encode($suppliers);
    }



    public function billsCustomerInsert(Request $request)
    {
        $inputs = $request->all();
        Customers::create($inputs);

        return redirect(Route('bills'))->with('successMsg', 'Customer successfully added !!');
    }
    

    

    public function billInsert(Request $request)
    {
        $inputs = $request->except(['pmntMethodTypeId', 'transactionAmount']);
        
        $lastCreatedBillId = Bills::create($inputs)->billId;

        foreach($request->itemId as $item=>$v)
        {
            $itemData=array
            (
                'billId'=>$lastCreatedBillId,
                'itemId'=>$request->itemId[$item],
                'supplierId'=>$request->supplierId[$item],
                'unitPrice'=>$request->unitPrice[$item],
                'soldQty'=>$request->soldQty[$item],
                'discountPercent'=>$request->discountPercent[$item],
                'totalPrice'=>$request->totalPrice[$item]
            );

            $billDetailId = BillDetails::create($itemData)->billDetailId;

        }


        if($request->pmntMethodTypeId!=null){

            foreach($request->pmntMethodTypeId as $pmntmethodtype=>$v)
            {
                $pmntmethodtypeData=array
                (
                    'billId'=>$lastCreatedBillId,
                    'pmntMethodTypeId'=>$request->pmntMethodTypeId[$pmntmethodtype],
                    'transactionAmount'=>$request->transactionAmount[$pmntmethodtype],
                    'transactionDate'=>dmyToYmd($request->transactionDate[$pmntmethodtype]),
                );

                Transactions::create($pmntmethodtypeData);
            }
        }

        return back()->with('successMsg', 'New Bill successfully added !!');
    }

    


    public function billInsertWithPDF(Request $request)
    {
        $inputs = $request->except(['pmntMethodTypeId', 'transactionAmount']);
        
        $lastCreatedBillId = Bills::create($inputs)->billId;

        foreach($request->itemId as $item=>$v)
        {
            $itemData=array
            (
                'billId'=>$lastCreatedBillId,
                'itemId'=>$request->itemId[$item],
                'supplierId'=>$request->supplierId[$item],
                'unitPrice'=>$request->unitPrice[$item],
                'soldQty'=>$request->soldQty[$item],
                'discountPercent'=>$request->discountPercent[$item],
                'totalPrice'=>$request->totalPrice[$item]
            );

            $billDetailId = BillDetails::create($itemData)->billDetailId;

        }


        if($request->pmntMethodTypeId!=null){

            foreach($request->pmntMethodTypeId as $pmntmethodtype=>$v)
            {
                $pmntmethodtypeData=array
                (
                    'billId'=>$lastCreatedBillId,
                    'pmntMethodTypeId'=>$request->pmntMethodTypeId[$pmntmethodtype],
                    'transactionAmount'=>$request->transactionAmount[$pmntmethodtype],
                    'transactionDate'=>dmyToYmd($request->transactionDate[$pmntmethodtype]),
                );

                Transactions::create($pmntmethodtypeData);
            }
        }


         echo "<script>window.open('/billing/bills/report/".$lastCreatedBillId."', '_blank').focus();</script>";

         echo "<script>location.href='/billing/bills/billCreate';</script>";

    }



    public function billList()
    {
        return view('billing/billList');
    }


    public function billListReport()
    {
        if (request()->has('billId')) {
            $listData = DB::table('billlistsummarypage_view')
                        ->where('billId', request('billId'))
                        ->get();
        }
        else{
            $listData = DB::table('billlistsummarypage_view')->get();
        }
        
        return datatables()->of($listData)->make(true);
    }





    public function billEdit($billId)
    {

        $customers = Customers::select('customerId', 'name', 'phone', 'address')->get();
        $items = DB::table('item_inventory_billdtls_view')->get();

        $billcalls = BillCalls::select('billCall','billCallId' )->get();
        $qcstatus = QCStatus::select('qcStatusId','qcStatus' )->get();
        $deliverystatus = DeliveryStatus::select('deliveryStatus','deliveryStatusId' )->get();
        $paymentstatus = PaymentStatus::select('paymentStatus','paymentStatusId' )->get();
        $pmntmethodtype = PmntMethodType::select('pmntMethodType','pmntMethodTypeId' )->get();

        $billData = DB::table('billlistsummary_view')->where('billId', $billId )->first();
        $billDetailsData = DB::table('billlistsummarydetails_view')->where('billId', $billId )->get();
        $transactionsData = DB::table('transactions_view')->where('billId', $billId )->get();

        

        return view('billing/billEdit', compact('billData','billDetailsData', 'customers', 'items', 'billcalls', 'qcstatus', 'deliverystatus', 'paymentstatus', 'pmntmethodtype', 'transactionsData'));

    }

    public function billUpdate(Request  $request,  $billId)
    {

        $this->validate(
            $request, 
            [   
                'customerId' => 'required',
            ],
            [   
                'customerId.required' => 'Customer is required.',
            ]
        );

        // dd($request->all());



        Bills::where('billId', $billId)->update($request->except(['_token','itemCode', 'itemId', 'description','unitPrice','soldQty',  'discountPercent', 'totalPrice', 'customerName', 'customerAddress', 'customerMobile', 'instock', 'buyingPrice', 'supplierId', 'inventoryId', 'billDetailId','pmntMethodTypeId', 'transactionAmount', 'supplierIdselector', 'transactionDate'])); 



        // first delete child data
         BillDetails::where('billId', $billId)->delete();


        foreach($request->itemId as $item=>$v)
        {
            $itemData=array
            (
                'billId'=>$billId,
                'itemId'=>$request->itemId[$item],
                'supplierId'=>$request->supplierId[$item],
                'unitPrice'=>$request->unitPrice[$item],
                'soldQty'=>$request->soldQty[$item],
                'discountPercent'=>$request->discountPercent[$item],
                'totalPrice'=>$request->totalPrice[$item]
            );
            $billDetailId = BillDetails::create($itemData)->billDetailId;

        }


        Transactions::where('billId', $billId)->delete();

        if($request->transactionAmount!=null){

            foreach($request->transactionAmount as $pmntmethodtype=>$v)
            {
                $pmntmethodtypeData=array
                (
                    'billId'=>$billId,
                    'pmntMethodTypeId'=>$request->pmntMethodTypeId[$pmntmethodtype],
                    'transactionAmount'=>$request->transactionAmount[$pmntmethodtype],
                    'transactionDate'=>dmyToYmd($request->transactionDate[$pmntmethodtype]),
                );
                Transactions::create($pmntmethodtypeData);
            }
        }


        return redirect(Route('billList').'?billId='.$billId)->with('successMsg', 'Bill successfully Updated !!');
    }


     public function billUpdateAndPrint(Request  $request,  $billId)
    {

        $this->validate(
            $request, 
            [   
                'customerId' => 'required',
            ],
            [   
                'customerId.required' => 'Customer is required.',
            ]
        );



        Bills::where('billId', $billId)->update($request->except(['_token','itemCode', 'itemId', 'description','unitPrice','soldQty',  'discountPercent', 'totalPrice', 'customerName', 'customerAddress', 'customerMobile', 'instock', 'buyingPrice', 'supplierId', 'inventoryId', 'billDetailId','pmntMethodTypeId', 'transactionAmount', 'supplierIdselector', 'transactionDate'])); 


        // first delete child data
         BillDetails::where('billId', $billId)->delete();

        foreach($request->itemId as $item=>$v)
        {
            $itemData=array
            (
                'billId'=>$billId,
                'itemId'=>$request->itemId[$item],
                'supplierId'=>$request->supplierId[$item],
                'unitPrice'=>$request->unitPrice[$item],
                'soldQty'=>$request->soldQty[$item],
                'discountPercent'=>$request->discountPercent[$item],
                'totalPrice'=>$request->totalPrice[$item]
            );
            $billDetailId = BillDetails::create($itemData)->billDetailId;
        }


        Transactions::where('billId', $billId)->delete();

        if($request->transactionAmount!=null){

            foreach($request->transactionAmount as $pmntmethodtype=>$v)
            {
                $pmntmethodtypeData=array
                (
                    'billId'=>$billId,
                    'pmntMethodTypeId'=>$request->pmntMethodTypeId[$pmntmethodtype],
                    'transactionAmount'=>$request->transactionAmount[$pmntmethodtype],
                    'transactionDate'=>dmyToYmd($request->transactionDate[$pmntmethodtype]),
                );
                Transactions::create($pmntmethodtypeData);
            }
        }


        echo "<script>window.open('/billing/bills/report/".$billId."', '_blank').focus();</script>";

         echo "<script>location.href='/billing/bills/billList?billId=".$billId."';</script>";

    }



    public function billDelete($billId)
    {
        foreach(DB::table('billdetails')->where('billId', $billId)->get() as $billdetail)
        {
            $inventoryId = $billdetail->inventoryId;
            self::outOfStockHandleForUpdate( $inventoryId);
        }

        Bills::where('billId', $billId)->delete(); 
        return redirect(Route('billList'))->with('successMsg', 'Bill successfully deleted !!');
    }




    

    public function customers()
    {
        $customerData = DB::table('customer_view')->get();

        $districts = DB::table('districts')->get();

        return view('billing/customers', compact('customerData', 'districts'));
    }

    public function customerInsert(Request $request)
    {
        $inputs = $request->all();
        Customers::create($inputs);

        return redirect(Route('customers'))->with('successMsg', 'Customer successfully added !!');
    }


    public function customerShow($customerId)
    {

         $districts = DB::table('districts')->get();

        $customer = Customers::where('customerId', $customerId)->first();

        return view('billing/customerUpdate', compact('customer', 'districts'));
    }


    public function customerUpdate(Request $request, $customerId)
    {



        Customers::find($customerId)->update($request->except(['_token'])); 

        return redirect(Route('customers'))->with('successMsg', 'Customer successfully updated !!');
    }

    public function customerDelete($customerId)
    {
        Customers::where('customerId',$customerId)->delete(); 

        return redirect(Route('customers'))->with('successMsg', 'Customer successfully deleted !!');
    }




    // BillList
    // delivery status update
    public function billListDeliveryStatusUpdate(Request $request, $billId )
    {

        $deliveryStatusId = Bills::where('billId', $billId)->pluck('deliveryStatusId')->first();

        if ($deliveryStatusId == 1) // done to pending  (1 to 2)
        {
            Bills::where('billId', $billId)->update(['deliveryStatusId' => 2]);
        }
        else  // pending to done  (2 to 1)
        {
            Bills::where('billId', $billId)->update(['deliveryStatusId' => 1]);
        }

        // return back();
        // return view('billing/billList');
        return "<script>location.href='/billing/bills/billList?#".$billId."';</script>";

    }

    // payment status update
    public function billListPaymentStatusUpdate(Request $request, $billId )
    {

        $pmntStatusId = Bills::where('billId', $billId)->pluck('pmntStatusId')->first();

        if ($pmntStatusId == 1) // paid to due  (1 to 2)
        {
            Bills::where('billId', $billId)->update(['pmntStatusId' => 2]);
        }
        else  // due to paid  (2 to 1)
        {
            Bills::where('billId', $billId)->update(['pmntStatusId' => 1]);
        }

        // return back();
        // return view('billing/billList');
        return "<script>location.href='/billing/bills/billList?#".$billId."';</script>";

    }


    // reports
    public function billReport($billId)
    {
        $billlistsummary = DB::table('billlistsummary_view')->where('billId', $billId)->first();
        $billlDetails = DB::table('billlistsummarydetails_view')->where('billId', $billId)->get();

        // number to word
        $ntw = new \NTWIndia\NTWIndia();
        $ntw = ($ntw->numToWord( $billlistsummary->totalReceivableAmount )).' Taka Only.';

        
        $pdf = PDF::loadView('billing.billReport', compact('billlistsummary', 'billlDetails', 'ntw'));
        // $pdf = PDF::loadView('billing.billReport', ['billId' => $billId]);
        // return $pdf->stream('billReport.pdf');
        return $pdf->stream($billlistsummary->invoiceNo.' ('.now().').pdf');
        // return $pdf->download('billReport.pdf');
        // return view('billing/billReport');
    }


    public function outOfStockHandle($itemId, $billDetailId){

        $inventoryId = DB::table('inventory')->where('outOfStock', '!=', 1)->where('itemId', $itemId)->pluck('inventoryId')->first();
        DB::table('billdetails')->where('billDetailId', $billDetailId)->update([
            'inventoryId' => $inventoryId
        ]);

        
        $billdetailsItemSoldQty = DB::table('billdetails')->where('itemId', $itemId)->sum('soldQty');
        $inventoryItemQty = DB::table('inventory')->where('itemId', $itemId)->where('inventoryId','<=', $inventoryId)->sum('quantity');

        $diffQty= $billdetailsItemSoldQty-$inventoryItemQty;

        // dd($diffQty);

        if ($diffQty>0) {
            DB::table('inventory')->where('inventoryId', $inventoryId)->update([
                'outOfStock' => 1
            ]);
        }
        else{
            DB::table('inventory')->where('inventoryId', $inventoryId)->update([
                'outOfStock' => 0
            ]);
        }

    }


    public function outOfStockHandleForUpdate($inventoryId){

        DB::table('inventory')->where('inventoryId', $inventoryId)->update([
            'outOfStock' => 0
        ]);

    }

    public function productSoldToWhomCustomerList(){
        $itemData = DB::table('item')->get();
        return view('billing.productsoldtowhomcustomerlist', compact('itemData'));
    }

    public function productSoldToWhomCustomerListData($itemId)
    {
        $listData = DB::table('billlistsummarydetails_view')->where('itemId', $itemId)->get();
        return datatables()->of($listData)->make(true);
    }



}
