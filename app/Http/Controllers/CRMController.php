<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\Expenses;
use App\ExpenseTypes;


class CRMController extends Controller
{

	public function valuableCustomers()
    {
        return view('crm/valuableCustomers');
    }


}
