<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and accessories'],
            ['name' => 'Clothing', 'description' => 'Apparel and fashion items'],
            ['name' => 'Food & Beverages', 'description' => 'Food items and drinks'],
            ['name' => 'Books', 'description' => 'Books and educational materials'],
            ['name' => 'Home & Garden', 'description' => 'Home improvement and garden items'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Create products
        $products = [
            // Electronics
            ['name' => 'Smartphone', 'sku' => 'ELE001', 'price' => 299.99, 'cost_price' => 200.00, 'stock_quantity' => 50, 'category_id' => 1, 'barcode' => '1234567890123'],
            ['name' => 'Laptop', 'sku' => 'ELE002', 'price' => 799.99, 'cost_price' => 600.00, 'stock_quantity' => 25, 'category_id' => 1, 'barcode' => '1234567890124'],
            ['name' => 'Headphones', 'sku' => 'ELE003', 'price' => 49.99, 'cost_price' => 30.00, 'stock_quantity' => 100, 'category_id' => 1, 'barcode' => '1234567890125'],
            ['name' => 'Tablet', 'sku' => 'ELE004', 'price' => 199.99, 'cost_price' => 150.00, 'stock_quantity' => 30, 'category_id' => 1, 'barcode' => '1234567890126'],
            
            // Clothing
            ['name' => 'T-Shirt', 'sku' => 'CLO001', 'price' => 19.99, 'cost_price' => 10.00, 'stock_quantity' => 200, 'category_id' => 2, 'barcode' => '2234567890123'],
            ['name' => 'Jeans', 'sku' => 'CLO002', 'price' => 59.99, 'cost_price' => 35.00, 'stock_quantity' => 75, 'category_id' => 2, 'barcode' => '2234567890124'],
            ['name' => 'Sneakers', 'sku' => 'CLO003', 'price' => 89.99, 'cost_price' => 60.00, 'stock_quantity' => 40, 'category_id' => 2, 'barcode' => '2234567890125'],
            
            // Food & Beverages
            ['name' => 'Coffee', 'sku' => 'FOO001', 'price' => 4.99, 'cost_price' => 2.50, 'stock_quantity' => 500, 'category_id' => 3, 'barcode' => '3234567890123'],
            ['name' => 'Sandwich', 'sku' => 'FOO002', 'price' => 7.99, 'cost_price' => 4.00, 'stock_quantity' => 100, 'category_id' => 3, 'barcode' => '3234567890124'],
            ['name' => 'Energy Drink', 'sku' => 'FOO003', 'price' => 2.99, 'cost_price' => 1.50, 'stock_quantity' => 300, 'category_id' => 3, 'barcode' => '3234567890125'],
            
            // Books
            ['name' => 'Programming Book', 'sku' => 'BOO001', 'price' => 39.99, 'cost_price' => 25.00, 'stock_quantity' => 60, 'category_id' => 4, 'barcode' => '4234567890123'],
            ['name' => 'Novel', 'sku' => 'BOO002', 'price' => 14.99, 'cost_price' => 8.00, 'stock_quantity' => 80, 'category_id' => 4, 'barcode' => '4234567890124'],
            
            // Home & Garden
            ['name' => 'Plant Pot', 'sku' => 'HOM001', 'price' => 12.99, 'cost_price' => 7.00, 'stock_quantity' => 150, 'category_id' => 5, 'barcode' => '5234567890123'],
            ['name' => 'Garden Tool Set', 'sku' => 'HOM002', 'price' => 29.99, 'cost_price' => 18.00, 'stock_quantity' => 45, 'category_id' => 5, 'barcode' => '5234567890124'],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        // Create sample customers
        $customers = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '+1234567890'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '+1234567891'],
            ['name' => 'Bob Johnson', 'email' => 'bob@example.com', 'phone' => '+1234567892'],
            ['name' => 'Alice Brown', 'email' => 'alice@example.com', 'phone' => '+1234567893'],
            ['name' => 'Charlie Wilson', 'email' => 'charlie@example.com', 'phone' => '+1234567894'],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }
    }
}
