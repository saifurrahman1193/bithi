<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function getRoleList()
    {
        $getRoleList = DB::table('roles')->get();

        if ( $getRoleList->isEmpty())
        {
            // return response()->json('Failure');
            $response = ["status" => "Failure", "data" => "No Role Exist!!!"];
            return response(json_encode($response), 404, ["Content-Type" => "application/json"]);
        }
        else 
        {
            // return response()->json('Success');
            $response = ["status" => "Success", "data" => $getRoleList];
            return response(json_encode($response, JSON_NUMERIC_CHECK), 200, ["Content-Type" => "application/json"]);
            
        }

    }

    
}
