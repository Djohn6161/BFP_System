<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type)
    {
        // dd($type);
        $exact_role = $request->user()->type;
        // if($exact_role === 'user'){
        //     return redirect('user/dashboard');
        // } elseif ($exact_role === 'admin'){
        //     return redirect('admin/dashboard');
        // }
        if($exact_role === $type){
            return $next($request);
        }else{
            return redirect()->route($exact_role . '.dashboard');
        }
        
    }
}
