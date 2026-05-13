<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::create(['name' => 'Seafood']);

        $category->products()->create([
            'name' => 'Udang Saus Padang',
            'description' => 'Udang segar dengan bumbu padang pedas manis.',
            'price' => 45000,
            'is_available' => true,
        ]);

        $category->products()->create([
            'name' => 'Cumi Goreng Tepung',
            'description' => 'Cumi krispi renyah dengan saus tartar.',
            'price' => 35000,
            'is_available' => true,
        ]);
    }
}