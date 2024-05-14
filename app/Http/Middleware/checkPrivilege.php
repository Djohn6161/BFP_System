<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $operation): Response
    {
        $user = Auth::user();
        // $userPrivilege = $user->privilege;
        // dd($user->privilege, $operation);
        if ($user->privilege == $operation || $user->privilege == 'All') {
            return $next($request);
        }else{
            return redirect()->route($user->type . '.dashboard')->with('status', 'Access denied. You are not authorized to perform this action.');
        }
    }
}
