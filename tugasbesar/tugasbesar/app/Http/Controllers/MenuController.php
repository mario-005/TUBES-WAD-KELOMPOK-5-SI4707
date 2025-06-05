<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
        {
            if (Auth::check() && Auth::user()->role !== 'admin') {
                return redirect()->route('dashboard');  
            }

            $menus = Menu::all(); 
            return view('menus.index', compact('menus'));  
        }
    public function create()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard'); 
        }

        return view('menus.create');
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard'); 
        }
        Menu::create($request->all());
        return redirect()->route('menus.index');
    }

    public function edit(Menu $menu)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard');  
        }

        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }

        $menu->update($request->all());
        return redirect()->route('menus.index');
    }

    public function destroy(Menu $menu)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard');  
        }

        $menu->delete();
        return redirect()->route('menus.index');
    }
}
