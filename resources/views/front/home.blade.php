@extends('layouts.app')

@section('content')
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 2.5rem; margin-bottom: 10px;">Welcome to Stylo</h1>
        <p style="color: #666;">Find your best style here.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px;">
        <!-- Example Product Cards -->
        @for($i = 1; $i <= 8; $i++)
            @include('components.product-card', [
                'title' => 'Product ' . $i,
                'price' => 'Rp ' . number_format(rand(50000, 500000)),
                'image' => 'https://via.placeholder.com/300x300',
                'link' => route('front.product', $i)
            ])
        @endfor
    </div>
@endsection
