<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'image' => 'https://placehold.co/600x400?text=Men',
            ],
            [
                'name' => 'Women\'s Collection',
                'image' => 'https://placehold.co/600x400?text=Women',
            ],
            [
                'name' => 'Accessories',
                'image' => 'https://placehold.co/600x400?text=Accessories',
            ],
            [
                'name' => 'Footwear',
                'image' => 'https://placehold.co/600x400?text=Footwear',
            ],
            [
                'name' => 'New Arrivals',
                'image' => 'https://placehold.co/600x400?text=New+Arrivals',
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
