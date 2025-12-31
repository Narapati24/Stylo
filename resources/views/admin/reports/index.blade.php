@extends('layouts.admin')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="bg-white border border-secondary p-6 rounded-lg shadow-sm">
    <h2 class="text-xl font-serif text-primary mb-6">Generate Laporan Transaksi</h2>
    
    <form action="{{ route('admin.reports.export') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date" id="end_date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/90 transition">
                Download PDF
            </button>
        </div>
    </form>
</div>
@endsection
