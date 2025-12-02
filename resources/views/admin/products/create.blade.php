@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Product Name</label>
            <input type="text" name="name" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Price</label>
            <input type="number" name="price" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Image</label>
            <input type="file" name="image">
        </div>

        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Save Product</button>
    </form>
@endsection
