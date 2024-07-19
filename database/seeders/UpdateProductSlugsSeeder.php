<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class UpdateProductSlugsSeeder extends Seeder
{
    public function run()
    {
        $products = Product::all();

        foreach ($products as $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                $product->save();
            }
        }
    }
}
