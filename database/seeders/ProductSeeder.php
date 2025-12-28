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
