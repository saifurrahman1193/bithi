<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bills;
use App\Transactions;
use App\TransactionType;
use App\BillType;
use App\SalaryDisbursement;





class BillsTransactionsController extends Controller
{

    public function salaryDisbursement()
    {

        return view('billstransactions/salaryDisbursement');
    }

    public function salaryDisbursementInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = SalaryDisbursement::create($inputs);

        return redirect(Route('salaryDisbursement'))->with('successMsg', 'New Salary Disbursement successfully added !!');
    }


    public function salaryDisbursementRep()
    {

        return view('billstransactions/salaryDisbursementRep');
    }

    public function salarySummaryRep()
    {

        return view('billstransactions/salarySummaryRep');
    }

    

    public function bills()
    {

        return view('billstransactions/bills');
    }

    public function billInsert(Request $request)
    {

        // validating form field before insert
        // 'status'=>'required' here, 'status' is a name of an input field
        $this->validate($request,[
            'status'=>'required'
        ]
        );

        $messages = [
            'status'    => 'The status must be filled !!!',

        ];


        $inputs = $request->all();
        
        $inputs = Bills::create($inputs);

        return redirect(Route('bills'))->with('successMsg', 'New Bill successfully added !!');
         // return response()->json($inputs);
    }


    public function billEdit($billId)
    {
        $billData = Bills::where('billId', $billId )->first();
        return view('billstransactions/billEdit', compact('billData'));

    }

    public function billUpdate(Request  $request,  $billId)
    {
        Bills::where('billId', $billId)->update($request->except(['_token'])); 

        return redirect(Route('bills'))->with('successMsg', 'Bill successfully Updated !!');
    }



    public function billDelete($billId)
    {
        Bills::find($billId)->delete(); 

        return redirect(Route('bills'))->with('successMsg', 'Bill successfully deleted !!');
    }





    public function transactions()
    {

        return view('billstransactions/transactions');
    }

    public function transactionInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = Transactions::create($inputs);

        return redirect(Route('transactions'))->with('successMsg', 'New Transaction successfully added !!');
         // return response()->json($inputs);
    }

    public function transactionEdit($transactionId)
    {
        $transactionData = Transactions::where('transactionId', $transactionId )->first();
        return view('billstransactions/transactionEdit', compact('transactionData'));

    }

    public function transactionUpdate(Request  $request,  $transactionId)
    {
        Transactions::where('transactionId', $transactionId)->update($request->except(['_token'])); 

        return redirect(Route('transactions'))->with('successMsg', 'Transaction successfully Updated !!');
    }


    public function transactionDelete($transactionId)
    {
        Transactions::find($transactionId)->delete(); 

        return redirect(Route('transactions'))->with('successMsg', 'Transaction successfully deleted !!');
    }




    public function transactionType()
    {

        return view('billstransactions/transactionType');
    }


    public function transactionTypeInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = TransactionType::create($inputs);

        return redirect(Route('billTransactionSettings'))->with('successMsg', 'New Transaction Type successfully added !!');
         // return response()->json($inputs);
    }




    public function transactionTypeDelete($transactionTypeId)
    {
        TransactionType::find($transactionTypeId)->delete(); 

        return redirect(Route('billTransactionSettings'))->with('successMsg', 'Transaction Type successfully deleted !!');
    }


    public function billType()
    {

        return view('billstransactions/billType');
    }


    public function billTypeInsert(Request $request)
    {
        $inputs = $request->all();
        
        $inputs = BillType::create($inputs);

        return redirect(Route('billTransactionSettings'))->with('successMsg', 'New Bill Type successfully added !!');
         // return response()->json($inputs);
    }




    public function billTypeDelete($billTypeId)
    {
        BillType::find($billTypeId)->delete(); 

        return redirect(Route('billTransactionSettings'))->with('successMsg', 'Bill Type successfully deleted !!');
    }


    public function billTransactionSettings()
    {

        return view('billstransactions/BillTransactionSettings');
    }


    



}
