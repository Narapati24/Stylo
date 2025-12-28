<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category' => 'Men\'s Collection',
                'name' => 'Basic Men T-Shirt',
                'price' => 150000,
                'stock' => 50,
                'thumbnail' => 'tshirt-men.jpg',
            ],
            [
                'category' => 'Women\'s Collection',
                'name' => 'Elegant Women Dress',
                'price' => 250000,
                'stock' => 30,
                'thumbnail' => 'dress-women.jpg',
            ],
            [
                'category' => 'Accessories',
                'name' => 'Luxury Wrist Watch',
                'price' => 500000,
                'stock' => 20,
                'thumbnail' => 'watch.jpg',
            ],
            [
                'category' => 'Footwear',
                'name' => 'Running Shoes',
                'price' => 350000,
                'stock' => 40,
                'thumbnail' => 'shoes.jpg',
            ],
        ];

        foreach ($products as $product) {
            $source = database_path('seeders/assets/products/' . $product['thumbnail']);
            $target = 'products/' . $product['thumbnail'];

            if (!Storage::disk('public')->exists($target)) {
                Storage::disk('public')->put($target, File::get($source));
            }

            Products::updateOrCreate(
                ['slug' => Str::slug($product['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'thumbnail' => $thumbnail,
                    'description' => 'High quality ' . $product['name'],
                ]
            );
        }
    }
}
