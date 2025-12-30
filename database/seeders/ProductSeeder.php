<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $files = File::files(database_path('seeders/assets/products'));

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
            
            // Determine Category and Name based on filename
            $categoryName = 'New Arrivals'; // Default
            $productName = ucwords(str_replace(['-', '_'], ' ', $nameWithoutExtension));
            $price = 100000;

            if (str_contains($filename, 'kemeja')) {
                $categoryName = 'Men\'s Collection';
                $productName = 'Classic Shirt ' . preg_replace('/[^0-9]/', '', $filename);
                $price = 250000;
            } elseif (str_contains($filename, 'baju')) {
                $categoryName = 'Women\'s Collection';
                $productName = 'Stylish Top ' . preg_replace('/[^0-9]/', '', $filename);
                $price = 150000;
            } elseif (str_contains($filename, 'hoodie')) {
                $categoryName = 'Men\'s Collection';
                $productName = 'Urban Hoodie ' . preg_replace('/[^0-9]/', '', $filename);
                $price = 350000;
            } elseif (str_contains($filename, 'jaket') || str_contains($filename, 'jacket')) {
                $categoryName = 'New Arrivals';
                $productName = 'Premium Jacket ' . preg_replace('/[^0-9]/', '', $filename);
                $price = 450000;
            } elseif (str_contains($filename, 'dress')) {
                $categoryName = 'Women\'s Collection';
                $productName = 'Elegant Dress';
                $price = 300000;
            } elseif (str_contains($filename, 'shoes') || str_contains($filename, 'footwear')) {
                $categoryName = 'Footwear';
                $productName = 'Comfort Shoes';
                $price = 400000;
            } elseif (str_contains($filename, 'watch') || str_contains($filename, 'accessories')) {
                $categoryName = 'Accessories';
                $productName = 'Luxury Watch';
                $price = 1500000;
            } elseif (str_contains($filename, 'tshirt')) {
                $categoryName = 'Men\'s Collection';
                $productName = 'Essential T-Shirt';
                $price = 120000;
            }

            // Find Category
            $category = Category::where('name', $categoryName)->first();
            if (!$category) {
                // Fallback if category not found (shouldn't happen if CategorySeeder ran)
                continue;
            }

            // Copy image
            $target = 'products/' . $filename;
            if (!Storage::disk('public')->exists($target)) {
                Storage::disk('public')->put($target, File::get($file->getPathname()));
            }

            // Create Product
            Products::updateOrCreate(
                ['slug' => Str::slug($productName . '-' . $filename)], // Unique slug
                [
                    'category_id' => $category->id,
                    'name' => $productName,
                    'price' => $price + rand(0, 50000), // Add some variation
                    'stock' => rand(10, 100),
                    'thumbnail' => $target,
                    'description' => $faker->paragraph(),
                    'created_at' => $faker->dateTimeBetween('-4 months', 'now'),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
