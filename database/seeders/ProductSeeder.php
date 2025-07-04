<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Electronics products
        $electronicsProducts = [
            [
                'name' => 'Smartphone X',
                'description' => 'Latest smartphone with advanced features',
                'sku' => 'ELEC-001',
                'barcode' => '1234567890123',
                'price' => 999.99,
                'cost_price' => 750.00,
                'stock_quantity' => 50,
                'category_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Laptop Pro',
                'description' => 'High-performance laptop for professionals',
                'sku' => 'ELEC-002',
                'barcode' => '1234567890124',
                'price' => 1499.99,
                'cost_price' => 1200.00,
                'stock_quantity' => 30,
                'category_id' => 1,
                'active' => true,
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'Premium wireless earbuds with noise cancellation',
                'sku' => 'ELEC-003',
                'barcode' => '1234567890125',
                'price' => 149.99,
                'cost_price' => 100.00,
                'stock_quantity' => 100,
                'category_id' => 1,
                'active' => true,
            ],
        ];

        // Clothing products
        $clothingProducts = [
            [
                'name' => 'Men\'s T-Shirt',
                'description' => 'Comfortable cotton t-shirt for men',
                'sku' => 'CLOTH-001',
                'barcode' => '2234567890123',
                'price' => 29.99,
                'cost_price' => 15.00,
                'stock_quantity' => 200,
                'category_id' => 2,
                'active' => true,
            ],
            [
                'name' => 'Women\'s Jeans',
                'description' => 'Stylish jeans for women',
                'sku' => 'CLOTH-002',
                'barcode' => '2234567890124',
                'price' => 59.99,
                'cost_price' => 35.00,
                'stock_quantity' => 150,
                'category_id' => 2,
                'active' => true,
            ],
        ];

        // Food & Beverages products
        $foodProducts = [
            [
                'name' => 'Organic Coffee',
                'description' => 'Premium organic coffee beans',
                'sku' => 'FOOD-001',
                'barcode' => '3234567890123',
                'price' => 12.99,
                'cost_price' => 8.00,
                'stock_quantity' => 100,
                'category_id' => 3,
                'active' => true,
            ],
            [
                'name' => 'Chocolate Bar',
                'description' => 'Delicious dark chocolate bar',
                'sku' => 'FOOD-002',
                'barcode' => '3234567890124',
                'price' => 3.99,
                'cost_price' => 2.00,
                'stock_quantity' => 300,
                'category_id' => 3,
                'active' => true,
            ],
        ];

        // Home & Kitchen products
        $homeProducts = [
            [
                'name' => 'Blender',
                'description' => 'High-speed blender for smoothies and more',
                'sku' => 'HOME-001',
                'barcode' => '4234567890123',
                'price' => 79.99,
                'cost_price' => 50.00,
                'stock_quantity' => 50,
                'category_id' => 4,
                'active' => true,
            ],
            [
                'name' => 'Cookware Set',
                'description' => 'Complete cookware set with non-stick coating',
                'sku' => 'HOME-002',
                'barcode' => '4234567890124',
                'price' => 199.99,
                'cost_price' => 150.00,
                'stock_quantity' => 30,
                'category_id' => 4,
                'active' => true,
            ],
        ];

        // Beauty & Personal Care products
        $beautyProducts = [
            [
                'name' => 'Facial Cleanser',
                'description' => 'Gentle facial cleanser for all skin types',
                'sku' => 'BEAUTY-001',
                'barcode' => '5234567890123',
                'price' => 14.99,
                'cost_price' => 8.00,
                'stock_quantity' => 100,
                'category_id' => 5,
                'active' => true,
            ],
            [
                'name' => 'Shampoo',
                'description' => 'Moisturizing shampoo for dry hair',
                'sku' => 'BEAUTY-002',
                'barcode' => '5234567890124',
                'price' => 9.99,
                'cost_price' => 5.00,
                'stock_quantity' => 150,
                'category_id' => 5,
                'active' => true,
            ],
        ];

        $allProducts = array_merge(
            $electronicsProducts,
            $clothingProducts,
            $foodProducts,
            $homeProducts,
            $beautyProducts
        );

        foreach ($allProducts as $product) {
            Product::create($product);
        }
    }
}
