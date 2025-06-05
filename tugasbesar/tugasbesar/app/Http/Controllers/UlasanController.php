<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UlasanController extends Controller
{
    protected $ulasan;

    public function __construct(Ulasan $ulasan)
    {
        $this->ulasan = $ulasan;
    }

    // Tampilkan semua ulasan (bisa untuk admin dan user)
    public function index()
    {
        $ulasans = $this->ulasan->all();
        return view('ulasan.index', compact('ulasans'));
    }

    // Tampilkan dashboard admin dengan ulasan (edit/hapus)
    public function adminDashboard()
    {
        $user = Auth::user();
        $role = trim(strtolower($user->role ?? ''));

        Log::info('Admin dashboard access attempt', [
            'user_id' => $user->id,
            'email' => $user->email,
            'role' => $role,
            'role_type' => gettype($role),
            'role_length' => strlen($role),
            'role_hex' => bin2hex($role),
            'is_admin' => $role === 'admin',
            'session_id' => session()->getId()
        ]);

        if ($role !== 'admin') {
            Log::warning('Unauthorized admin dashboard access', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $role
            ]);
            abort(403, 'Unauthorized action. Current role: ' . $role);
        }

        $ulasans = $this->ulasan->all();
        return view('ulasan.dashboard', compact('ulasans'));
    }

    // Form tambah ulasan (hanya user)
    public function create()
    {
        return view('ulasan.create');
    }

    // Simpan ulasan baru (hanya user)
    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah_makan' => 'required|string|max:255',
            'nama_pengulas' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        $this->ulasan->create($request->only('nama_rumah_makan', 'nama_pengulas', 'rating', 'komentar'));

        return redirect()->route('ulasan.index')->with('success', 'Ulasan berhasil ditambahkan.');
    }

    // Tampilkan detail ulasan
    public function show(Ulasan $ulasan)
    {
        return view('ulasan.show', compact('ulasan'));
    }

    // Form edit ulasan (admin only)
    public function edit(Ulasan $ulasan)
    {
        return view('ulasan.edit', compact('ulasan'));
    }

    // Update ulasan (admin only)
    public function update(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'nama_rumah_makan' => 'required|string|max:255',
            'nama_pengulas' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        $ulasan->update($request->only('nama_rumah_makan', 'nama_pengulas', 'rating', 'komentar'));

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    // Hapus ulasan (admin only)
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}
