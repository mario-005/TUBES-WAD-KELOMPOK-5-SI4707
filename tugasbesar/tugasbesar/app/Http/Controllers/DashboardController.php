<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role !== 'user') {
            return redirect()->route('menus.index'); 
        } else {
            $menus = Menu::all();
            return view('dashboard', compact('menus')); 
        }
    }
}
