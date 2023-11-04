<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roleMiddleware): Response
    {
        $role = Auth::user()->role;
        if(Str::lower($role) === $roleMiddleware) {
            return $next($request);
        } else {
            if($role === 'Admin') {
                return redirect()->route('admin.index');
            }
            if($role === 'Inspektor') {
                return redirect()->route('inspektor.index');
            }
            return redirect()->route('peminjam.index');
        }
    }
}
