@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login - Your App</title>

        <!-- Internal CSS -->
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            p{
                text-align: center;
                color: #555;
                font-size: 14px;
            }

            .container {
                max-width: 500px;
                margin: 0 auto;
                padding: 30px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-top: 70px;
            }

            h1 {
                font-size: 2rem;
                text-align: center;
                color: #333;
                margin-bottom: 20px;
            }


            label {
                font-size: 1rem;
                color: #555;
                margin-bottom: 5px;
                display: block;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 1rem;
            }

            button[type="submit"] {
                width: 100%;
                padding: 12px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                font-size: 1.1rem;
                cursor: pointer;
                margin-top: 15px;
            }

            button[type="submit"]:hover {
                background-color: #0056b3;
            }

            .mt-3 {
                margin-top: 20px;
                text-align: center;
            }

            .mt-3 a {
                color: #007bff;
                text-decoration: none;
            }

            .mt-3 a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Selamat Datang</h1>
            <p>Silahkan Masukan Untuk Melanjutkan Ke halaman berikutnya </p>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <div class="mt-3">
                <p>Don't have an account? <a href="{{ route('register') }}">Create one here</a></p>
            </div>
        </div>
    </body>
    </html>
@endsection
