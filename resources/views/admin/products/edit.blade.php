@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Product Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name}}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <!-- slug -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ $product->slug}}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
             
        </div>

          <div style="margin-bottom: 15px;">
        <label>Category</label>
        <select name="category_id"
                style="width: 100%; padding: 8px;"
                required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        </div>  

        <!-- Price -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Price</label>
            <input type="number" name="price" value="{{ $product->price}}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <!-- Stock -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Stock</label>
            <input type="number" name="stock" value="{{ $product->stock}}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <!-- Description-->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ $product->description}}</textarea>
        </div>

        <!-- Thumbnail -->
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Thumbnail</label>
            <input type="file" name="thumbnail">
            @error('thumbnail')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Update Product</button>

    </form>

    <script>
document.getElementById('name').addEventListener('input', function(e) {
    let slug = e.target.value.toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');

    document.getElementById('slug').value = slug;
});
</script>

@endsection
