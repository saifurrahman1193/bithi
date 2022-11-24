<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $admin_role_check = null;
        if (Auth::check()) 
        {
            
            $admin_role_check = DB::table('userroles')
                                   ->where('userId', auth::user()->id )
                                   ->whereIn('roleId', [1,2])  // 2 = admin
                                   ->value('roleId');
        }



        if ($admin_role_check===null) 
        {
            return redirect('/');
        }else {
            
            return $next($request);
        }
    }
}
