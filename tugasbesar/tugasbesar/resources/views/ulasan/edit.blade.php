@extends('layouts.app')

@section('title', 'Edit Ulasan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Ulasan</div>

                <div class="card-body">
                    <form action="{{ route('admin.ulasan.update', $ulasan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_rumah_makan" class="form-label">Nama Rumah Makan</label>
                            <input type="text" class="form-control @error('nama_rumah_makan') is-invalid @enderror" 
                                id="nama_rumah_makan" name="nama_rumah_makan" 
                                value="{{ old('nama_rumah_makan', $ulasan->nama_rumah_makan) }}" required>
                            @error('nama_rumah_makan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_pengulas" class="form-label">Nama Pengulas</label>
                            <input type="text" class="form-control @error('nama_pengulas') is-invalid @enderror" 
                                id="nama_pengulas" name="nama_pengulas" 
                                value="{{ old('nama_pengulas', $ulasan->nama_pengulas) }}" required>
                            @error('nama_pengulas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select @error('rating') is-invalid @enderror" 
                                id="rating" name="rating" required>
                                <option value="">Pilih rating</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', $ulasan->rating) == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea class="form-control @error('komentar') is-invalid @enderror" 
                                id="komentar" name="komentar" rows="3" required>{{ old('komentar', $ulasan->komentar) }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Update Ulasan</button>
                            <a href="{{ route('admin.ulasan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
