<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is an admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            // If the user is not an admin, redirect them to the dashboard
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
