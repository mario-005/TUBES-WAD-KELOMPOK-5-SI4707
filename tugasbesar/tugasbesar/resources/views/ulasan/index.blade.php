{{-- resources/views/ulasan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Ulasan')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Ulasan</h2>
        @if(auth()->check() && auth()->user()->role === 'user')
            <a href="{{ route('ulasan.create') }}" class="btn btn-primary">+ Tambah Ulasan</a>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Rumah Makan</th>
                    <th>Nama Pengulas</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($ulasans as $ulasan)
                <tr>
                    <td>{{ $ulasan->nama_rumah_makan }}</td>
                    <td>{{ $ulasan->nama_pengulas }}</td>
                    <td>{{ $ulasan->rating }}</td>
                    <td>{{ $ulasan->komentar }}</td>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <td>
                        <a href="{{ route('admin.ulasan.edit', $ulasan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.ulasan.destroy', $ulasan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
