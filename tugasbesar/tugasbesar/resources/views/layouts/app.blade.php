<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Sistem Ulasan')</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Global Styles */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn-primary:hover {
            background-color: #004085;
            border-color: #003766;
            box-shadow: 0 0 8px rgba(0, 64, 133, 0.6);
        }
        .btn-warning.btn-sm,
        .btn-danger.btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            transition: background-color 0.3s ease;
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
        .table-dark th {
            background-color: #343a40;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f5f9;
            cursor: pointer;
        }
        .table td, .table th {
            padding: 0.75rem 1rem;
        }
        .alert-success {
            box-shadow: 0 2px 6px rgba(40, 167, 69, 0.3);
        }
        @media (max-width: 576px) {
            .btn {
                font-size: 0.85rem;
                padding: 0.4rem 0.7rem;
            }
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Sistem Ulasan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ulasan.index') }}">Ulasan</a>
                    </li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.ulasan.index') }}">Admin Panel</a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 