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
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'image' => $category['image'],
                'description' => 'Explore our exclusive ' . $category['name'] . ' with earthy tones and premium materials.',
                'is_active' => true,
            ]);
        }
    }
}
