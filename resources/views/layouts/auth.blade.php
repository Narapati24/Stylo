<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stylo') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans text-primary antialiased bg-bone min-h-screen flex items-center justify-center p-4">
    
    <main class="w-full max-w-[420px] bg-white px-8 py-10 rounded-3xl shadow-xl relative">
        {{-- Close Button --}}
        <a href="{{ route('front.home') }}" class="absolute top-5 right-5 text-gray-400 hover:text-primary transition-colors p-2 rounded-full hover:bg-gray-50" title="Back to Home">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </a>

        @yield('content')
    </main>

    <!-- Toast Notification -->
    <div 
        x-data="{ 
            show: false, 
            message: '', 
            type: 'success',
            timeout: null,
            notify(message, type = 'success') {
                this.show = true;
                this.message = message;
                this.type = type;
                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => this.show = false, 3000);
            }
        }" 
        @notify.window="notify($event.detail.message, $event.detail.type)"
        x-show="show" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="fixed bottom-5 right-5 z-50 px-6 py-3 rounded-lg shadow-lg text-white font-medium flex items-center gap-3"
        :class="{
            'bg-black': type === 'success',
            'bg-red-600': type === 'error',
            'bg-yellow-500': type === 'warning',
            'bg-blue-500': type === 'info'
        }"
        style="display: none;"
    >
        <span x-text="message"></span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                @if(session('success') || session('status'))
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: @json(session('success') ?? session('status')), type: 'success' } }));
                @endif
                @if(session('error'))
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: @json(session('error')), type: 'error' } }));
                @endif
                @if(session('warning'))
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: @json(session('warning')), type: 'warning' } }));
                @endif
                @if(session('info'))
                    window.dispatchEvent(new CustomEvent('notify', { detail: { message: @json(session('info')), type: 'info' } }));
                @endif
            }, 500);
        });
    </script>
</body>
</html>