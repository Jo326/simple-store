<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .table-container {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f9f9f9;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn-add-product {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-add-product:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-warning, .btn-danger {
            transition: background-color 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #d39e00;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Product List</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('products.create') }}" class="btn btn-add-product mb-3"><i class="fas fa-plus"></i> Add New Product</a>
        <div class="table-container">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Retail Price</th>
                        <th>Wholesale Price</th>
                        <th>Min Wholesale Qty</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($products->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    @else
                        @foreach($products as $index => $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->description }}</td>
                            <td>${{ number_format($product->retail_price, 2) }}</td>
                            <td>${{ number_format($product->wholesale_price, 2) }}</td>
                            <td>{{ $product->min_wholesale_qty }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <form action="{{ route('products.show', $product) }}" method="GET" style="display:inline;">
                                    <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Show</button>
                                </form>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</body>
</html>
