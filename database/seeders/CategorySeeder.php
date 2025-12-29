<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Men\'s Collection',
                'image' => 'menwear.jpg',
            ],
            [
                'name' => 'Women\'s Collection',
                'image' => 'womenwear.jpg',
            ],
            [
                'name' => 'Accessories',
                'image' => 'accessories.jpg',
            ],
            [
                'name' => 'Footwear',
                'image' => 'footwear.jpg',
            ],
            [
                'name' => 'New Arrivals',
                'image' => 'newarrivals.jpg',
            ],
        ];

        foreach ($categories as $category) {
            $source = database_path('seeders/assets/categories/' . $category['image']);
            $target = 'categories/' . $category['image'];

            if (!Storage::disk('public')->exists($target)) {
                Storage::disk('public')->put($target, File::get($source));
            }

            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                [
                    'name' => $category['name'],
                    'image' => $target, // PATH yang valid
                    'description' => 'Explore our exclusive ' . $category['name'],
                    'is_active' => true,
                ]
            );
        }
    }
}
