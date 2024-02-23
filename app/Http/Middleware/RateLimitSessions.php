<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RateLimitSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ipAddress = $request->ip();

        $getIpadress = DB::table('visitors_table')->where("ip_address" , $ipAddress)->first();
    
        if($getIpadress){
            if (session()->has('allowed_ip') || session('allowed_ip') == $ipAddress) {
             return $next($request);
            } else {
                return response()->view('warning');
            }
    
        }else{
            DB::table('visitors_table')->insert(['ip_address' => $ipAddress]);
            session(['allowed_ip' => $ipAddress]);
            return $next($request);
        }
    }
}
