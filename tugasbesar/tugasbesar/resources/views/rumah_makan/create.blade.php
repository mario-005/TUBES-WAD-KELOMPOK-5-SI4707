@extends('rumah_makan.layout')

@section('content')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
        }

        .container {
            max-width: 1600;
            margin: 10px auto;
            background-color: #f9fbff;
            padding: 40px;
            border-radius: 16px;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 6px;
        }

        p.description {
            text-align: center;
            font-size: 14px;
            color: #475569;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 6px;
            color: #0f172a;
        }

        input[type="text"],
        input[type="file"],
        input[type="time"] {
            width: 100%;
            padding: 10px 14px;
            font-size: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background-color: #fff;
        }

        .form-group input::placeholder {
            color: #cbd5e1;
        }

        .time-inputs {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .time-inputs input[type="time"] {
            flex: 1;
        }

        .upload-box {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            color: #94a3b8;
            font-size: 14px;
        }

        .upload-box input[type="file"] {
            display: none;
        }

        .upload-box label {
            display: block;
            cursor: pointer;
            color: #94a3b8;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-cancel,
        .btn-submit {
            padding: 10px 24px;
            font-size: 14px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        .btn-submit {
            background-color: #6366f1;
            color: white;
        }

        .btn-submit:hover {
            background-color: #4f46e5;
        }

        .note {
            margin-top: 8px;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>

    <div class="container">
        <h2>Form Tambah Restaurant</h2>
        <p class="description">Lengkapi Form Berikut untuk Menambahkan Restaurant Baru</p>

        <form action="{{ route('rumah-makan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Restaurant </label>
                <input type="text" id="nama" name="nama" placeholder="Tuliskan nama Restaurant" required>
            </div>

            <div class="form-group">
                <label for="kategori">Jenis Masakan </label>
                <input type="text" id="kategori" name="kategori" placeholder="Ex: Japanese" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat </label>
                <input type="text" id="alamat" name="alamat" placeholder="Tuliskan Alamat Restaurant" required>
            </div>

            <div class="form-group">
                <label for="jam_buka">Jam Buka</label>
                <div class="time-inputs">
                    <input type="time" id="jam_buka" name="jam_buka">
                    <input type="time" id="jam_tutup" name="jam_tutup">
                </div>
            </div>

            <div class="form-group">
                <label for="kontak">Kontak</label>
                <input type="text" id="kontak" name="kontak" placeholder="Nomor kontak (optional)">
            </div>

            <div class="form-group">
                <label for="foto">Masukkan Foto Restaurant </label>
                <div class="upload-box" onclick="document.getElementById('foto').click();">
                    <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/jpg,image/gif,video/mp4" onchange="handleFileUpload(this)">
                    <label for="foto" id="file-label">Choose a file or drag & drop it here</label>
                    <div class="note">JPEG, PNG, PDG, and MP4 formats, up to 50MB</div>
                </div>
            </div>

            


            <div class="actions">
                <button type="button" class="btn-cancel" onclick="window.history.back()">Cancel</button>
                <button type="submit" class="btn-submit">Tambah</button>
            </div>
        </form>
    </div>

    <script>
        function handleFileUpload(input) {
            const label = document.getElementById('file-label');
            if (input.files.length > 0) {
                label.textContent = input.files[0].name;
            }
        }
    </script>
@endsection
