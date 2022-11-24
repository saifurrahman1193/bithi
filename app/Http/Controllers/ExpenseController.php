<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use App\Expenses;
use App\ExpenseTypes;


class ExpenseController extends Controller
{

	public function expenseIndex()
    {
        $expenseTypes = ExpenseTypes::select('expenseTypeId', 'expenseType')->get();
        $expenses = DB::table('expense_view')->get();

        return view('expense/expenses', compact('expenseTypes', 'expenses'));
    }

    public function expenseInsert(Request $request)
    {
        $inputs = $request->all();
        Expenses::create($inputs);
        return redirect(Route('expense.expenses.index'))->with('successMsg', 'Expense successfully added !!');
    }


    public function expenseUpdate(Request $request)
    {
        Expenses::find($request->expenseId)->update($request->all()); 
        return redirect(Route('expense.expenses.index'))->with('successMsg', 'Expense successfully updated !!');
    }


    public function expenseDelete($expenseId)
    {
        Expenses::where('expenseId', $expenseId)->delete(); 
        return redirect(Route('expense.expenses.index'))->with('successMsg', 'Expense successfully deleted !!');
    }



}
