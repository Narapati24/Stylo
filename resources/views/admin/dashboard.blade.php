@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="font-serif text-3xl text-primary mb-2">Dashboard</h1>
        <p class="text-gray-500 text-sm">Welcome back to Stylo Admin.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white border border-secondary p-6">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Total Products</h3>
            <p class="font-serif text-4xl text-primary">{{ $totalProducts }}</p>
            <div class="mt-4 text-xs text-green-600 flex items-center gap-1">
                <span>↑ 12%</span>
                <span class="text-gray-400">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white border border-secondary p-6">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Total Orders</h3>
            <p class="font-serif text-4xl text-primary">45</p>
            <div class="mt-4 text-xs text-green-600 flex items-center gap-1">
                <span>↑ 5%</span>
                <span class="text-gray-400">vs last month</span>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white border border-secondary p-6">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Revenue</h3>
            <p class="font-serif text-4xl text-primary">Rp 15.000.000</p>
            <div class="mt-4 text-xs text-red-600 flex items-center gap-1">
                <span>↓ 2%</span>
                <span class="text-gray-400">vs last month</span>
            </div>
        </div>
    </div>
@endsection
