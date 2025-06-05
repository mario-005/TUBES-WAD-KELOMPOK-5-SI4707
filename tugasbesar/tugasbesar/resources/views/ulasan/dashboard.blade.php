{{-- resources/views/ulasan/admin_dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin - Ulasan</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #212529;
            text-align: center;
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f1f5f9;
        }
        .table td, .table th {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }
        .btn-warning.btn-sm,
        .btn-danger.btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            transition: background-color 0.3s ease;
            border-radius: 4px;
        }
        .btn-warning.btn-sm:hover {
            background-color: #e0a800;
            border-color: #d39e00;
            color: #212529;
        }
        .btn-danger.btn-sm:hover {
            background-color: #bd2130;
            border-color: #b02a37;
        }
        .alert-success {
            box-shadow: 0 2px 6px rgba(40, 167, 69, 0.3);
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 15px 20px;
                margin: 20px auto;
            }
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <h2>Dashboard Admin - Daftar Ulasan</h2>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Rumah Makan</th>
                        <th>Nama Pengulas</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ulasans as $ulasan)
                    <tr>
                        <td>{{ $ulasan->nama_rumah_makan }}</td>
                        <td>{{ $ulasan->nama_pengulas }}</td>
                        <td>{{ $ulasan->rating }}</td>
                        <td>{{ $ulasan->komentar }}</td>
                        <td>
                            <a href="{{ route('ulasan.edit', $ulasan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('ulasan.destroy', $ulasan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data ulasan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
