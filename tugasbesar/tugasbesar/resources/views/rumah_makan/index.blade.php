<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Rumah Makan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px 60px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .btn-add {
            background-color: #10b981;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-add:hover {
            background-color: #059669;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        .card-header {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .card-body {
            padding: 20px;
            flex-grow: 1;
        }

        .title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
        }

        .subtitle {
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 4px;
        }

        .time {
            margin-top: 12px;
            font-weight: bold;
            color: #1e293b;
        }

        .rating {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stars {
            color: #facc15;
            font-size: 1rem;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            background-color: #f9fafb;
        }

        .btn,
        .actions form button {
            flex: 1;
            padding: 10px 0;
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            text-align: center;
            min-width: 80px;
            display: inline-block;
        }

        .btn-info { background-color: #3b82f6; }
        .btn-warning { background-color: #f59e0b; }
        .btn-danger { background-color: #ef4444; }

        .btn-info:hover { background-color: #2563eb; }
        .btn-warning:hover { background-color: #d97706; }
        .btn-danger:hover { background-color: #dc2626; }

        .actions form {
            flex: 1;
            margin: 0;
            display: flex;
        }

        .actions form button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Daftar Rumah Makan</h1>
            <a href="{{ route('rumah-makan.create') }}" class="btn-add">+ Tambah Rumah Makan</a>
        </div>

        <div class="grid">
            @foreach ($rumahMakans as $rm)
                <div class="card">
                    <div class="card-header" style="background-image: url('https://source.unsplash.com/400x300/?restaurant');"></div>
                    <div class="card-body">
                        <div class="title">{{ $rm->nama }}</div>
                        <div class="subtitle">{{ $rm->kategori }} | {{ $rm->alamat }}</div>
                        <div class="time">{{ date('h.i A', strtotime($rm->jam_buka)) }} - {{ date('h.i A', strtotime($rm->jam_tutup)) }}</div>
                        <div class="rating">
                            <span class="stars">★ ★ ★ ☆ ☆</span>
                            ({{ rand(100, 5000) }} reviews)
                        </div>
                    </div>
                    <div class="actions">
                        <a href="{{ route('rumah-makan.show', $rm->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('rumah-makan.edit', $rm->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('rumah-makan.destroy', $rm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
