@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Create Menu</title>

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

            textarea.form-control {
                height: 100px;
                resize: vertical;
            }

            select.form-control {
                cursor: pointer;
            }

            button[type="submit"] {
                background-color:rgb(0, 13, 255);
                color: white;
                padding: 12px 20px;
                border-radius: 5px;
                text-decoration: none;
                display: inline-block;
                width: auto;  
                text-align: center;
                margin-top: 10px; 
            }

            button[type="submit"]:hover {
                background-color: #0056b3;
            }

            .btn-back {
                background-color: #6c757d;
                color: white;
                padding: 12px 20px;
                border-radius: 5px;
                text-decoration: none;
                display: inline-block;
                width: auto;  /* Automatically adjusts width based on content */
                text-align: center;
                margin-top: 10px;  /* Add some space between the buttons */
            }

            .btn-back:hover {
                background-color: #5a6268;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Create Menu</h1>

            <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="available">Available</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('dashboard') }}" class="btn-back">Back to Dashboard</a>
            </form>
        </div>
    </body>
    </html>
@endsection
