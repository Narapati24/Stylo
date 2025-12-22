@extends('layouts.app')

@section('content')
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Welcome to Stylo</h1>
        <p style="color: #666;">Find your best style here.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
        <!-- Example Product Cards -->
        @foreach($products as $product)
            @include('components.product-card', [
                'title' => $product->name,
                'price' => 'Rp ' . number_format($product->price),
                'image' => $product->image_url,
                'link' => route('front.product', $product->id)
            ])
        @endforeach
    </div>
@endsection
