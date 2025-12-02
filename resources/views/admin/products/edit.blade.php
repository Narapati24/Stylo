@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <form action="{{ route('admin.products.update', $product->id ?? 1) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Product Name</label>
            <input type="text" name="name" value="{{ $product->name ?? '' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Price</label>
            <input type="number" name="price" value="{{ $product->price ?? '' }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ $product->description ?? '' }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Image</label>
            <input type="file" name="image">
        </div>

        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Update Product</button>
    </form>
@endsection
