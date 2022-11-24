<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Item;
use App\Requisition;
use App\BillList;


class AccountsController extends Controller
{

    public function accountsProductRequisitions()
    {
        return view('/accounts/requisitions');
    }


    // bill generation againstproduct requision
    public function accProductReqCreateInvoice( $requisitionId)
    {

        $requisition = Requisition::where('requisitionId', $requisitionId)->get();

        return view('/accounts/invoice', compact('requisition'));

    }


    public function accProductReqCreateInvoiceInsert(Request $request)
    {
        
        $BillList = BillList::get();

        $inputs = $request->all();
        BillList::create($inputs);

        return redirect(Route('accountsProductRequisitions'))->with('successMsg', 'Bill successfully generated !!');
        
    }



    public function accProdReqInvoiceEditForm($requisitionId)
    {
        $prodInvoiceData = BillList::where('requisitionId', $requisitionId )->get(); 
        $requisition = Requisition::where('requisitionId', $requisitionId )->get(); 

        return view('accounts/invoiceAgainstProdReqEdit', compact('prodInvoiceData', 'requisition'));
    }


    public function accProdReqInvoiceUpdate(Request $request , $requisitionId)
    {

        BillList::where('requisitionId', $requisitionId)->update($request->except(['_token'])); 

        return redirect(Route('accountsProductRequisitions'))->with('successMsg', 'Bill Against Product requisition successfully Updated !!');

    }







    // bill generation fabric requision======================
    public function accProductReqCreateFabricReqInvoice( $requisitionId)
    {

        $requisition = Requisition::where('requisitionId', $requisitionId)->get();

        return view('/accounts/invoiceAgainstFabricReq', compact('requisition'));

    }



    public function accProductReqCreateFabricReqInvoiceInsert(Request $request)
    {
        
        $BillList = BillList::get();

        $inputs = $request->all();
        BillList::create($inputs);

        return redirect(Route('accountsProductRequisitions'))->with('successMsg', 'Bill successfully generated !!');
        
    }


    // accFabricReqInvoiceEditForm
    public function accFabricReqInvoiceEditForm($requisitionId)
    {
        $fabricInvoiceData = BillList::where('requisitionId', $requisitionId )->get(); 
        $fabricInvoiceRequisitionData = Requisition::where('requisitionId', $requisitionId )->get(); 

        return view('accounts/invoiceAgainstFabricReqEditForm', compact('fabricInvoiceData', 'fabricInvoiceRequisitionData'));
    }



    // accFabricReqInvoiceUpdate
    public function accFabricReqInvoiceUpdate(Request $request , $requisitionId)
    {

        BillList::where('requisitionId', $requisitionId)->update($request->except(['_token'])); 

        return redirect(Route('accountsProductRequisitions'))->with('successMsg', 'Bill Against fuel requisition successfully Updated !!');

    }










    // bill generation fuel requision==============
    public function accProductReqCreateFuelReqInvoice( $requisitionId)
    {

        $requisition = Requisition::where('requisitionId', $requisitionId)->get();

        return view('/accounts/invoiceAgainstFuelReq', compact('requisition'));

    }



    public function accProductReqCreateFuelReqInvoiceInsert(Request $request)
    {
        
        $BillList = BillList::get();

        $inputs = $request->all();
        BillList::create($inputs);

        return redirect(Route('accountsProductRequisitions'))->with('successMsg', 'Bill successfully generated !!');
        
    }



    public function accFuelReqInvoiceEditForm($requisitionId)
    {
        $fuelInvoiceData = BillList::where('requisitionId', $requisitionId )->get(); 
        $fuelInvoiceRequisitionData = Requisition::where('requisitionId', $requisitionId )->get(); 

        return view('accounts/invoiceAgainstFuelReqEditForm', compact('fuelInvoiceData', 'fuelInvoiceRequisitionData'));
    }


    public function accFuelReqInvoiceUpdate(Request $request , $requisitionId)
    {

        BillList::where('requisitionId', $requisitionId)->update($request->except(['_token'])); 

        return redirect(Route('accountsProductRequisitions'))->with('successMsg', 'Bill Against fuel requisition successfully Updated !!');

    }





    






}
