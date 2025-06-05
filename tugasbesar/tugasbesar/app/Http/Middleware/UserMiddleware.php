<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            Log::warning('User access attempt: User not authenticated');
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Get fresh user data from database
        $dbUser = DB::table('users')->where('id', $user->id)->first();
        if (!$dbUser) {
            Log::error('User not found in database', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);
            Auth::logout();
            return redirect()->route('login');
        }

        $role = trim(strtolower($dbUser->role ?? ''));

        Log::info('User role check', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $role,
            'role_type' => gettype($role),
            'role_length' => strlen($role),
            'role_hex' => bin2hex($role),
            'is_user' => $role === 'user',
            'session_id' => session()->getId(),
            'is_authenticated' => Auth::check(),
            'auth_id' => Auth::id(),
            'request_path' => $request->path(),
            'request_method' => $request->method()
        ]);

        if ($role !== 'user') {
            Log::warning('Unauthorized user access attempt', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $role,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'request_path' => $request->path(),
                'request_method' => $request->method()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized action.'], 403);
            }
            
            return redirect()->route('home')->with('error', 'Unauthorized action.');
        }

        return $next($request);
    }
} 