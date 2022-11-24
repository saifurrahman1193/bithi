<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hr;
use App\Payroll;
use App\Suppliers;
use App\Attendance;
use App\AttendanceStatus;
use DB;


class HRMCOntroller extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


   


    // ===============supplier========================================
    // ===============supplier========================================

    public function supplier()
    {
        return view('hrm/supplier');
    }

    public function supplierInsert(Request $request)
    {
        $inputs = $request->all();
        
        Suppliers::create($inputs);

        return redirect(Route('supplier'))->with('successMsg', 'Supplier successfully added !!');
    }



    public function supplierShow($supplierId)
    {
        $supplierData = Suppliers::where('supplierId', $supplierId )->first();
        return view('hrm/supplierEdit', compact('supplierData'));

    }



    public function supplierUpdate(Request  $request,  $supplierId)
    {
        Suppliers::where('supplierId', $supplierId)->update($request->except(['_token'])); 

        return redirect(Route('supplier'))->with('successMsg', 'Supplier successfully Updated !!');
    }



    public function supplierDelete($supplierId)
    {
        Suppliers::where('supplierId', $supplierId)->delete(); 

        return redirect(Route('supplier'))->with('successMsg', 'Supplier successfully deleted !!');
    }

    

   
}
