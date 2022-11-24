<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Roles;


class RoleController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        // employer access
        // $this->middleware('auth', ['only' => ['create']]); // to restrict guest 
        // $this->middleware('EmployerMiddleware', ['only' => ['create']]); // to restrict employee

        $this->middleware('SuperAdminMiddleware',   ['only' => [ 'create','show', 'index','edit','store','update','destroy']]);
        // $this->middleware('AdminMiddleware',   ['only' => ['edit']]);
        // $this->middleware('permission:view-posts',   ['only' => ['show', 'index']]);


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::table('roles')
                ->get();

        return view('role.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $roles = new Roles();
        // $roles->Role=$request->Role;
        // $roles->Role_desc=$request->Role_desc;

        // $roles->save();
        
        $roles = Roles::get();

        $inputs = $request->all();
        Roles::create($inputs);

        // return response()->json($roles);
        // return response()->json(['success'=>'Data is successfully added']);
        return view('role.index', compact('roles'));
        
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
        $roleData = Roles::where('roleId','=', $id)->get();

        return view('role.edit', compact('roleData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roleId)
    {
        Roles::where('roleId', $roleId)->update($request->except(['_token'])); 

        return redirect(Route('role.index'))->with('successMsg', 'Role successfully updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($roleId)
    {
        Roles::where('roleId', $roleId)->delete(); 

        return redirect(Route('role.index'))->with('successMsg', 'Role successfully deleted !!');
    }
}
