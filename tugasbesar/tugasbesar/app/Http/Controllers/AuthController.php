<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $dbUser = DB::table('users')->where('id', $user->id)->first();
            $role = trim(strtolower($dbUser->role ?? ''));
            
            if ($role === 'admin') {
                return redirect('/admin/ulasan');
            }
            return redirect('/ulasan');
        }
        
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        
        return view('auth.register');
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role is user
        ]);

        Log::info('User registered', [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);

        Auth::login($user);

        return redirect('/ulasan');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $dbUser = DB::table('users')->where('id', $user->id)->first();
            $role = trim(strtolower($dbUser->role ?? ''));
            
            if ($role === 'admin') {
                return redirect('/admin/ulasan');
            }
            return redirect('/ulasan');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        Log::info('Login attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $dbUser = DB::table('users')->where('id', $user->id)->first();
            $role = trim(strtolower($dbUser->role ?? ''));

            Log::info('Login successful', [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role,
                'role_type' => gettype($role),
                'role_length' => strlen($role),
                'role_hex' => bin2hex($role),
                'session_id' => session()->getId()
            ]);

            // Store user role in session
            session(['user_role' => $role]);

            if ($role === 'admin') {
                return redirect('/admin/ulasan');
            } else {
                return redirect('/ulasan');
            }
        }

        Log::warning('Login failed', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $dbUser = DB::table('users')->where('id', $user->id)->first();
            Log::info('Logout', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $dbUser->role ?? 'unknown',
                'session_id' => session()->getId()
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
} 