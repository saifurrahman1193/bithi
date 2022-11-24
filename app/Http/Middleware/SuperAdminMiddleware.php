<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $super_admin_role_check = null;

        if (Auth::check()) {
            
            $super_admin_role_check = DB::table('userroles')
                                   ->where('userId', auth::user()->id )
                                   ->Where('roleId', 1 )  // 1 = admin
                                   ->value('roleId');
        }
       


        if ($super_admin_role_check===null) 
        {
            return redirect(route('dashboard'));
        }else {
            
            return $next($request);
        }


    }


}
