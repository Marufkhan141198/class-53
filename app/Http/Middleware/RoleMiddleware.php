<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request,Closure $next,...$roles)
    {
        if(!Auth::check()){
            return redirect('/admin/login');
        }

        $authUser = Auth::user();

        if(!in_array($authUser->role,$roles)){
            abort(403,'Access denied');

        }

        return $next($request);
    }
}
