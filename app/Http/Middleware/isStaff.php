<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guest()) {
            return redirect()->route('general.login');
        } else if (auth()->user()->role == 1) {
            return redirect()->route('user.index');
        } else if (auth()->user()->role == 9) {
            return $next($request);
        }
    }
}
