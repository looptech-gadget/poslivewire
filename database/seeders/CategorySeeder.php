<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'active' => true,
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and fashion items',
                'active' => true,
            ],
            [
                'name' => 'Food & Beverages',
                'description' => 'Food and drink items',
                'active' => true,
            ],
            [
                'name' => 'Home & Kitchen',
                'description' => 'Home and kitchen appliances and accessories',
                'active' => true,
            ],
            [
                'name' => 'Beauty & Personal Care',
                'description' => 'Beauty and personal care products',
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
