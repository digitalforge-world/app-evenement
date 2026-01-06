<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * 
     * @param  \Illuminate\Http\request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next ,string $role): Response
    {
        /*if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }*/
        if (! Auth::user()->hasRole($role)) {
            return redirect()->to(route('/'));
        }


        return $next($request);
    }
}
