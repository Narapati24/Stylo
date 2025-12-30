@extends('layouts.app')

@section('content')
<div class="collection-container">
    <header class="collection-header">
        <h1 class="collection-title">Stylo Collections</h1>
        <p class="collection-subtitle">Explore our curated collections and find the definitive pieces for your style.</p>
    </header>

    <section class="collection-grid">
        @foreach($categories as $category)
        <div class="category-card">
            <div class="category-image">
                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">
                <div class="category-overlay">
                    <a href="{{ route('front.home', ['category_id' => $category->id]) }}" class="view-btn">Explore {{ $category->name }}</a>
                </div>
            </div>
            <div class="category-info">
                <h3>{{ $category->name }}</h3>
            </div>
        </div>
        @endforeach
    </section>
</div>
@endsection