@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div x-data="{ 
    search: '{{ request('search') }}',
    category: '{{ request('category') }}',
    async performSearch(pageUrl = null) {
        try {
            const params = {};
            let url = '{{ route('admin.products.index') }}';
            
            if (pageUrl) {
                url = pageUrl;
            } else {
                if (this.search) params.search = this.search;
                if (this.category) params.category = this.category;
            }

            const response = await axios.get(url, {
                params: params,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            document.getElementById('products-table-body').innerHTML = response.data.html;
            document.getElementById('pagination-container').innerHTML = response.data.pagination;
        } catch (error) {
            console.error('Search failed:', error);
        }
    },
    init() {
        // Handle pagination clicks
        document.getElementById('pagination-container').addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link) {
                e.preventDefault();
                this.performSearch(link.href);
            }
        });
    }
}">
    <x-admin.layout-crud title="Products" :create-url="route('admin.products.create')" create-text="Add New Product">
        
        <div class="mb-6 flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:w-1/3">
                <input x-model="search" 
                       @input.debounce.500ms="performSearch()" 
                       type="text" 
                       placeholder="Search products..." 
                       class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2 text-sm placeholder-gray-400">
            </div>
            
            <div class="w-full md:w-1/3">
                <select x-model="category" 
                        @change="performSearch()"
                        class="w-full border-secondary focus:border-primary focus:ring-0 rounded-lg bg-bone px-4 py-2 text-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-secondary text-xs uppercase tracking-wider text-gray-500">
                    <th class="py-4 px-4 font-medium">No</th>
                    <th class="py-4 px-4 font-medium">Image</th>
                    <th class="py-4 px-4 font-medium">Name</th>
                    <th class="py-4 px-4 font-medium">Category</th>
                    <th class="py-4 px-4 font-medium">Price</th>
                    <th class="py-4 px-4 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm" id="products-table-body">
                @include('admin.products.partials.table-rows')
            </tbody>
        </table>
        
        <div class="mt-4" id="pagination-container">
            {{ $products->links() }}
        </div>
    </x-admin.layout-crud>
</div>
@endsection
