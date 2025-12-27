@extends('layouts.app')

<link href="{{ asset('css/about.css') }}" rel="stylesheet">


@section('content')
<div class="about-container">
    <section class="about-hero">
        <div class="hero-content">
            <h1 class="about-title">What Is Stylo?</h1>
            <p class="about-subtitle">We're bridging the gap between raw natural inspiration and sophisticated design. Stylo offers a curated collection for the modern individual who values quiet luxury and conscious living.</p>
        </div>
        <div class="hero-image-wrapper">
            <img src="{{ asset('images/long shirts.jpg') }}" alt="Stylo Classic Shirts" class="hero-img">
        </div>
    </section>

    <section class="mission-section">
        <div class="mission-grid">
            <div class="mission-text">
                <span class="section-tag">Our Philosophy</span>
                <h2>Timelessness for Everyday Wear</h2>
                <p>Inspired by natural textures and a serene color palette, each of our collections is designed to become a meaningful part of your life’s journey. We believe true luxury lies in the harmony of high-quality fabrics and timeless silhouettes that transcend fleeting trends.</p>
            </div>
            <div class="mission-image">
                <img src="{{ asset('images/woman purses.jpg') }}" alt="Stylo Purses Collection" class="hero-img">
            </div>
        </div>
    </section>

    <section class="values-section">
        <div class="section-header">
            <h2>Stylo Main Values</h2>
        </div>
        <div class="about-features grid md:grid-cols-3 gap-8">
            <div class="feature-card">
                <h3 class="feature-title">Sustainable</h3>
                <p class="feature-text">We prioritize eco-friendly materials and ethical production processes from start to finish.</p>
            </div>
            <div class="feature-card">
                <h3 class="feature-title">Timeless Design</h3>
                <p class="feature-text">We create classic, timeless forms designed to be cherished and relevant for decades to come.</p>
            </div>
            <div class="feature-card">
                <h3 class="feature-title">Luxury Artistry</h3>
                <p class="feature-text">Precision in every stitch. Our artisans devote absolute attention to the smallest details, ensuring every piece is a soulful work of art.</p>
            </div>
        </div>
    </section>
</div>
@endsection