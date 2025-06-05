@extends('rumah_makan.layout')

@section('content')
    <div class="container">
        <h1>Detail Rumah Makan</h1>
        <p><strong>Nama:</strong> {{ $rumahMakan->nama }}</p>
        <p><strong>Alamat:</strong> {{ $rumahMakan->alamat }}</p>
        <p><strong>Kontak:</strong> {{ $rumahMakan->kontak }}</p>
        <p><strong>Kategori:</strong> {{ $rumahMakan->kategori }}</p>
        <a href="{{ route('rumah-makan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
