<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin.products.index', compact('products'));
    }

    //create product
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    //simpan product
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnailPath = $request->file('thumbnail')
            ->store('products', 'public');

        Products::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    //edit product
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    //update product
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:products,slug,' . $product->id,
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'required',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // update slug
        $validated['slug'] = Str::slug($validated['name']) . '-' . time();

        // upload thumbnail jika diganti
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] =
                $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    //delete product
    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    //hitung total produk untuk dashboard
    public function dashboard()
    {
        $totalProducts = Products::count();
        return view('admin.dashboard', compact('totalProducts'));
    }
}
