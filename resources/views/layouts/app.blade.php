<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylo Store</title>
    <!-- Tambahkan CSS di sini -->
    @livewireStyles
</head>
<body>
    <!-- Navbar -->
    <nav style="background: #f8f9fa; padding: 15px; border-bottom: 1px solid #ddd;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('front.home') }}" style="font-weight: bold; font-size: 1.2rem; text-decoration: none;">Stylo</a>
            <div>
                <a href="{{ route('front.home') }}" style="margin-right: 15px;">Home</a>
                <a href="{{ route('front.cart') }}">Cart</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding: 20px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: #333; color: #fff; padding: 20px; text-align: center; margin-top: 50px;">
        &copy; {{ date('Y') }} Stylo Store. All rights reserved.
    </footer>

    @livewireScripts
</body>
</html>
