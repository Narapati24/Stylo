<div class="product-card" style="border: 1px solid #ddd; padding: 15px; border-radius: 8px;">
    <img src="{{ $image ?? 'https://via.placeholder.com/150' }}" alt="{{ $title }}" style="width: 100%; height: auto; margin-bottom: 10px;">
    <h3 style="font-size: 1.1rem; margin-bottom: 5px;">{{ $title }}</h3>
    <p style="color: #888; font-size: 0.9rem;">{{ $price }}</p>
    <a href="{{ $link ?? '#' }}" style="display: block; background: #007bff; color: white; text-align: center; padding: 8px; text-decoration: none; border-radius: 4px; margin-top: 10px;">View Details</a>
</div>
