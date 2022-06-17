<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(100)->create(['description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras in.'])->each(function ($product) {
            $product->addMediaFromUrl('https://source.unsplash.com/random')->toMediaCollection('product');
        });
    }
}
