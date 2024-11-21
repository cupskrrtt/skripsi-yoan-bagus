<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class CalculatePriceSeeder extends Seeder
{
    public function run()
    {
        $products = Product::with('materials')->get();

        foreach ($products as $product) {
            $purchasePrice = 0;
            foreach ($product->materials as $material) {
                $quantity = $material->pivot->quantity;
                $purchasePrice += $material->purchase_price * $quantity;
            }
            $product->purchase_price = $purchasePrice;
            $product->save();
        }
    }
}
