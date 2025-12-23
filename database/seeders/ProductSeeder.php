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
        $faker = Faker::create();
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 5; $i++) {
                $name = $faker->words(3, true);
                Products::create([
                    'category_id' => $category->id,
                    'name' => ucfirst($name),
                    'slug' => Str::slug($name),
                    'price' => $faker->numberBetween(100000, 2000000),
                    'stock' => $faker->numberBetween(10, 100),
                    'description' => $faker->paragraph(3),
                    'thumbnail' => 'https://placehold.co/600x400?text=' . urlencode($name),
                ]);
            }
        }
    }
}
