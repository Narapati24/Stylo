@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.products.create') }}" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">+ Add New Product</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f1f1f1; text-align: left;">
                <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Image</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>

            @forelse($products as $product)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $product->id }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <img src="{{ $product->image_url }}" alt="Product" width="50">
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{ $product->name }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($product->price) }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="color: blue; margin-right: 10px;">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; border: 1px solid #ddd;">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
