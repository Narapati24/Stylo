@extends('layouts.app')

@section('content')
    <div style="display: flex; gap: 40px;">
        <div style="flex: 1;">
            <img src="https://via.placeholder.com/500" alt="Product Image" style="width: 100%; border-radius: 8px;">
        </div>
        <div style="flex: 1;">
            <h1 style="font-size: 2rem; margin-bottom: 10px;">Product Title</h1>
            <p style="font-size: 1.5rem; color: #007bff; margin-bottom: 20px;">Rp 150.000</p>
            <p style="line-height: 1.6; color: #555; margin-bottom: 30px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
            <button style="background: #007bff; color: white; padding: 15px 30px; border: none; border-radius: 4px; font-size: 1.1rem; cursor: pointer;">Add to Cart</button>
        </div>
    </div>
@endsection
