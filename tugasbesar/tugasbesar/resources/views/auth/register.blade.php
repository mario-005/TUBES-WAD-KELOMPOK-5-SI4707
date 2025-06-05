@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register - Your App</title>

        <!-- Internal CSS -->
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-top: 50px;
            }

            h1 {
                font-size: 2rem;
                color: #333;
                margin-bottom: 20px;
                text-align: center;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                font-weight: bold;
                font-size: 14px;
            }

            .form-control {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                border-radius: 5px;
                border: 1px solid #ddd;
            }

            .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            }

            button[type="submit"] {
                background-color: #007bff;
                color: white;
                padding: 12px 20px;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                font-size: 16px;
                width: 100%;
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
            <h1>Register</h1>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>

            <div class="mt-3">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </div>
    </body>
    </html>
@endsection
