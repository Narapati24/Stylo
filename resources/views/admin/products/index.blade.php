@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div x-data="{ 
    search: '{{ request('search') }}',
    async performSearch(pageUrl = null) {
        try {
            const params = {};
            let url = '{{ route('admin.products.index') }}';
            
            if (pageUrl) {
                url = pageUrl;
            } else {
                params.search = this.search;
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
        
        <div class="mb-6">
            <input x-model="search" 
                   @input.debounce.500ms="performSearch()" 
                   type="text" 
                   placeholder="Search products..." 
                   class="w-full md:w-1/3 border-secondary focus:border-primary focus:ring-0 rounded-none bg-bone px-4 py-2 text-sm placeholder-gray-400">
        </div>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-secondary text-xs uppercase tracking-wider text-gray-500">
                    <th class="py-4 px-4 font-medium">No</th>
                    <th class="py-4 px-4 font-medium">Image</th>
                    <th class="py-4 px-4 font-medium">Name</th>
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
