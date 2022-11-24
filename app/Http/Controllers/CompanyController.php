<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Company;

use \Input as Input;


class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function company()
    {
        $company = DB::table('company')->first();

        return view('company/companySettings', compact('company'));
    }

   


    public function companyUpdate(Request $request, $companyId)
    {

        $this->validate($request, [
          'name'  => 'required',
          'contact'  => 'required',
          'email'  => 'required',
          'logoUrl'  => 'image|mimes:jpg,png,gif,PNG,jpeg,JPEG,GIF|max:2048s'
         ]);

        Company::where('companyId',$companyId)->update($request->except(['_token'])); 

        if(Input::hasFile('logoUrl')){

            // echo 'Uploaded';
            $file = Input::file('logoUrl');
            // $file->move('uploads', $file->getClientOriginalName());
            $file->move('uploads/company/logo', 'company_logo'.'.'.$file->getClientOriginalExtension());
            Company::find($companyId)->update(['logoUrl' => '/uploads/company/logo/company_logo'.'.'.$file->getClientOriginalExtension()]); 
        }

        return redirect(Route('company'))->with('successMsg', 'Company information saved !!');
    }



}
