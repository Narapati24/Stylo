<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Stylo</title>
    <!-- Tambahkan CSS di sini (Tailwind/Bootstrap) -->
    @livewireStyles
</head>
<body>
    <div class="admin-container" style="display: flex;">
        <!-- Sidebar -->
        <aside style="width: 250px; background: #333; color: #fff; min-height: 100vh; padding: 20px;">
            <h3>Admin Panel</h3>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" style="color: #fff;">Dashboard</a></li>
                <li><a href="{{ route('admin.products.index') }}" style="color: #fff;">Products</a></li>
                <li><a href="#" style="color: #fff;">Categories</a></li>
                <li><a href="#" style="color: #fff;">Reports</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main style="flex: 1; padding: 20px;">
            <header style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                <h2>@yield('title', 'Dashboard')</h2>
            </header>

            @if(session('success'))
                <div style="background: green; color: white; padding: 10px; margin-bottom: 10px;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>
</html>
