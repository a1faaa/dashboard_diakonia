<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isUser
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
            return $next($request);
        } else if (auth()->user()->role == 9) {
            return redirect()->route('staf.index');
        }
    }
}
