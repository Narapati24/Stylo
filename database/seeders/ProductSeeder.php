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

        $adjectives = ['Premium', 'Exclusive', 'Timeless', 'Modern', 'Elegant', 'Sophisticated', 'Minimalist', 'Urban', 'Classic', 'Heritage', 'Artisan', 'Refined', 'Signature', 'Essential', 'Luxe', 'Ethereal', 'Vintage', 'Contemporary'];
        $materials = ['Cotton', 'Silk', 'Linen', 'Wool', 'Leather', 'Denim', 'Velvet', 'Cashmere', 'Satin', 'Canvas', 'Suede', 'Organic', 'Textured'];
        
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
            
            // Determine Category and Base Name based on filename
            $categoryName = 'New Arrivals'; // Default
            $baseName = 'Piece';
            $price = 100000;

            // Pick random adjective and material
            $adj = $adjectives[array_rand($adjectives)];
            $mat = $materials[array_rand($materials)];

            if (str_contains($filename, 'kemeja') || $filename === 'shirts.jpg') {
                $categoryName = 'Men\'s Collection';
                $baseName = 'Oxford Shirt';
                $price = 350000;
            } elseif (str_contains($filename, 'baju')) {
                $categoryName = 'Women\'s Collection';
                $baseName = 'Blouse';
                $price = 250000;
            } elseif (str_contains($filename, 'hoodie')) {
                $categoryName = 'Men\'s Collection';
                $baseName = 'Pullover Hoodie';
                $price = 450000;
            } elseif (str_contains($filename, 'jaket') || str_contains($filename, 'jacket') || str_contains($filename, 'outerwear')) {
                $categoryName = 'New Arrivals';
                $baseName = 'Bomber Jacket';
                if (str_contains($filename, 'outerwear')) $baseName = 'Trench Coat';
                $price = 650000;
            } elseif (str_contains($filename, 'dress')) {
                $categoryName = 'Women\'s Collection';
                $baseName = 'Evening Dress';
                $price = 550000;
            } elseif (str_contains($filename, 'shoes') || str_contains($filename, 'footwear')) {
                $categoryName = 'Footwear';
                $baseName = 'Sneakers';
                $price = 800000;
            } elseif (str_contains($filename, 'watch')) {
                $categoryName = 'Accessories';
                $baseName = 'Chronograph Watch';
                $price = 2500000;
            } elseif (str_contains($filename, 'neckles') || str_contains($filename, 'accessories')) {
                $categoryName = 'Accessories';
                $baseName = 'Pendant Necklace';
                $price = 450000;
            } elseif (str_contains($filename, 'tshirt') || str_contains($filename, 't-shirt')) {
                $categoryName = 'Men\'s Collection';
                $baseName = 'Tee';
                $price = 180000;
            } elseif (str_contains($filename, 'bottoms')) {
                $categoryName = 'Men\'s Collection';
                $baseName = 'Chino Pants';
                $price = 300000;
            }

            // Construct Luxury Name
            $namingPattern = rand(1, 3);
            if ($namingPattern == 1) {
                $productName = "$adj $mat $baseName";
            } elseif ($namingPattern == 2) {
                $productName = "$adj $baseName";
            } else {
                $productName = "The $adj $baseName";
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
                ['slug' => Str::slug($productName . '-' . $filename)], // Unique slug using filename to avoid collisions
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
