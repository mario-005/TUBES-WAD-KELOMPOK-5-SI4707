@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Selamat Datang di Sistem Ulasan</div>

                <div class="card-body">
                    <h5 class="card-title">Apa yang bisa Anda lakukan?</h5>
                    
                    @guest
                        <p class="card-text">
                            Untuk mulai memberikan ulasan, silakan login atau daftar terlebih dahulu.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                        </div>
                    @else
                        <p class="card-text">
                            @if(auth()->user()->role === 'admin')
                                Sebagai admin, Anda dapat mengelola semua ulasan yang ada di sistem.
                            @else
                                Anda dapat memberikan ulasan untuk rumah makan yang telah Anda kunjungi.
                            @endif
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('ulasan.index') }}" class="btn btn-primary">Lihat Ulasan</a>
                            @if(auth()->user()->role === 'user')
                                <a href="{{ route('ulasan.create') }}" class="btn btn-success">Tambah Ulasan</a>
                            @endif
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.ulasan.index') }}" class="btn btn-warning">Admin Panel</a>
                            @endif
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 