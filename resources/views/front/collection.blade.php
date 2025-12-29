@extends('layouts.app')

@section('content')
<div class="collection-container">
    <header class="collection-header">
        <h1 class="collection-title">Stylo Collections</h1>
        <p class="collection-subtitle">Explore our curated collections and find the definitive pieces for your style.</p>
    </header>

    <section class="collection-grid">
        @php
            $items = [
                ['name' => 'Outerwear', 'slug' => 'outerwear', 'img' => 'outerwear.jpg'],
                ['name' => 'Shirts', 'slug' => 'shirt', 'img' => 'shirts.jpg'],
                ['name' => 'T-Shirts', 'slug' => 't-shirt', 'img' => 't-shirt.jpg'],
                ['name' => 'Bottoms', 'slug' => 'bottoms', 'img' => 'bottoms.jpg'],
                ['name' => 'Accessories', 'slug' => 'accessories', 'img' => 'accessories.jpg'],
            ];
        @endphp

        @foreach($items as $item)
        <div class="category-card">
            <div class="category-image">
                <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['name'] }}">
                <div class="category-overlay">
                    <a href="{{ url('/shop/'.$item['slug']) }}" class="view-btn">Explore {{ $item['name'] }}</a>
                </div>
            </div>
            <div class="category-info">
                <h3>{{ $item['name'] }}</h3>
            </div>
        </div>
        @endforeach
    </section>
</div>
@endsection