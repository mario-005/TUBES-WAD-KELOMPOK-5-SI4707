<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu List</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background-color: rgb(78, 176, 238);
            color: white;
            position: sticky;
            top: 0;
            z-index: 100;
            align-items: center;
        }

        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            align-items: center;
        }

        .hamburger .line {
            width: 30px;
            height: 3px;
            background-color: white;
            transition: transform 0.3s ease;
        }

        .welcome-message {
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 200px;
            background-color: rgb(78, 176, 238);
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 80px; /* Adjusted to start below the header */
            left: -250px;
            height: calc(100% - 80px); /* To ensure sidebar doesn't cover the header */
            transition: transform 0.3s ease-in-out;
            z-index: 99;
        }

        .sidebar.open {
            transform: translateX(250px);
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h3 {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 30px;
        }

        .close-btn {
            display: flex;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .close-btn .line {
            width: 30px;
            height: 3px;
            background-color: white;
        }

        .sidebar-menu {
            list-style: none;
            padding-left: 0;
        }

        .sidebar-menu li {
            margin-bottom: 20px;
        }

        .sidebar-menu li a {
            text-decoration: none;
            color: white;
            font-size: 1.1rem;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-menu li a:hover {
            background-color: #4d6272;
        }

        /* Main Content */
        .main-content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
            margin-top: 80px;
        }

        .main-content.open {
            margin-left: 250px;
        }

        .page-title {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .menu-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-body h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: #333;
        }

        .card-body p {
            font-size: 0.95rem;
            margin: 5px 0;
            color: #666;
        }

        .card-actions {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn-warning,
        .btn-danger {
            padding: 6px 12px;
            font-size: 0.9rem;
            border-radius: 5px;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .no-menu {
            text-align: center;
            font-size: 1.2rem;
            color: #888;
        }

        .card-actions {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <header class="header">
            <div class="hamburger" onclick="toggleSidebar()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <div class="welcome-message">
                <h4>Welcome, {{ Auth::user()->name }}!</h4>
            </div>
        </header>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3>Telkom Makan</h3>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('menus.index') }}">Menu List</a></li>
                <li><a href="{{ route('menus.create') }}">Add Menu</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: inherit; padding: 0; font: inherit; cursor: pointer; text-decoration: none;">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="page-title">Menu List</h1>

            @if($menus->isEmpty())
                <p class="no-menu">No menu items found.</p>
            @else
                <div class="menu-grid">
                    @foreach ($menus as $menu)
                        <div class="card">
                            <img src="{{ $menu->image ? asset('storage/images/menus/' . $menu->image) : asset('default.png') }}" alt="Menu Image">
                            <div class="card-body">
                                <h3>{{ $menu->name }}</h3>
                                <p><strong>Price: Rp</strong> {{ $menu->price }}</p>
                                <p><strong>Status:</strong> {{ $menu->status }}</p>
                                <p><strong>Description:</strong> {{ $menu->description }}</p>

                                <div class="card-actions">
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn-warning">Edit</a>

                                    <form class="delete-form" data-id="{{ $menu->id }}" action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-danger delete-button">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('open');
        };

        // SweetAlert2 Delete Confirmation
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = button.closest('.delete-form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
