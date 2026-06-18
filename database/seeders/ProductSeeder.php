<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
    'name' => 'Laptop',
    'sku' => 'LP001'
]);

Product::create([
    'name' => 'Mouse',
    'sku' => 'MS001'
]);

Product::create([
    'name' => 'Keyboard',
    'sku' => 'KB001'
]);
    }
    
}
