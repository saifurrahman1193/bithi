<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Religion;
use App\Nationality;
use App\Gender;



use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Auth;






class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    // public function __construct()
    // {
    //     // $this->middleware('auth');
    //     // employer access
    //     // $this->middleware('auth', ['only' => ['create']]); // to restrict guest 
    //     // $this->middleware('EmployerMiddleware', ['only' => ['create']]); // to restrict employee

    //     $this->middleware('SuperAdminMiddleware',   ['only' => ['create','show', 'index','edit','store','update','destroy', 'userRoles', ]]);
    //     // $this->middleware('AdminMiddleware',   ['only' => ['edit']]);
    //     // $this->middleware('permission:view-posts',   ['only' => ['show', 'index']]);


    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * users_details_view ------view=========
     */
    public function index()
    {

        $users = DB::table('users')
                ->get();

        return view('user.index', compact('users'));
    }

    public function userRoles()
    {

        $users = DB::table('users')
                ->get();

        return view('user/userRoles', compact('users'));
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        

        $users = User::all();


        return view('user.create', compact('users'));
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|regex:/^.+@.+$/i|unique:users', // forcing to accept duplicate for that record not for others
            'name' => 'required|string|max:255',
        ]);

        /**
         * all data from form input has bee stored in $request collection
         */
        $inputs = $request->all();

        
        /**
         * save into database
         */
        User::create($inputs);

        return redirect(Route('user.index'))->with('successMsg', 'User successfully added !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $users = User::where('id','=', $id)->get();

        return view('user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     User::find($id)->update($request->all()); 

    //     return redirect(Route('user.index'))->with('successMsg', 'User successfully updated !!');
    // }
    public function update(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|min:4|unique:users,email,'.$request->id.',id', // forcing to accept duplicate for that record not for others
            'name' => 'required|string|max:255',
        ]);

        // $messages = [
        //     'name'    => 'Name is a required field !',

        // ];

        if ($request->password == null) 
        {
            User::find($request->id)->update($request->except(['password'])); 
        }else {
            User::find($request->id)->update($request->all()); 
        }

        return redirect(Route('user.index'))->with('successMsg', 'User successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     User::find($id)->delete(); 

    //     return redirect(Route('user.index'))->with('successMsg', 'User successfully deleted !!');
    // }


    public function destroy(Request $request)
    {
        User::find($request->userId)->delete(); 

        return redirect(Route('user.index'))->with('successMsg', 'User successfully deleted !!');
    }




}
