<?php

namespace App\Http\Controllers;

use App\Models\RumahMakan;
use Illuminate\Http\Request;

class RumahMakanController extends Controller
{
    public function index()
    {
        $rumahMakans = RumahMakan::all();
        return view('rumah_makan.index', compact('rumahMakans'));
    }

    public function create()
    {
        return view('rumah_makan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'kategori' => 'required|string|max:255',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'foto' => 'nullable|image|max:51200', 
        ]);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $validated['foto'] = $path;
        }

        RumahMakan::create($validated);

        return redirect()->route('rumah-makan.index')->with('success', 'Data berhasil ditambahkan');
    }


    public function show($id)
    {
        $rumahMakan = RumahMakan::findOrFail($id);
        return view('rumah_makan.show', compact('rumahMakan'));
    }

    public function edit($id)
    {
        $rumahMakan = RumahMakan::findOrFail($id);
        return view('rumah_makan.edit', compact('rumahMakan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'kategori' => 'required|string|max:255',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'foto' => 'nullable|image|max:51200',
        ]);

        $rumahMakan = RumahMakan::findOrFail($id);
        
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/fotos');
            $validated['foto'] = $path;
        }

        $rumahMakan->update($validated);

        return redirect()->route('rumah-makan.index')->with('success', 'Data rumah makan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $rumahMakan = RumahMakan::findOrFail($id);
        $rumahMakan->delete();

        return redirect()->route('rumah-makan.index')->with('success', 'Rumah makan berhasil dihapus!');
    }
}
