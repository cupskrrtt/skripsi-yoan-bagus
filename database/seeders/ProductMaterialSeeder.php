<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Material;    
use Illuminate\Support\Facades\DB;

class ProductMaterialSeeder extends Seeder
{
    public function run()
    {
        // Define sample product and material IDs
        $productIds = Product::pluck('id')->toArray();
        $materialIds = Material::pluck('id')->toArray();

        // Define the number of relationships you want to create for each product
        $numberOfRelationshipsPerProduct = 3;

        // Create sample relationships between products and materials
        foreach ($productIds as $productId) {
            // Shuffle the material IDs to get random materials for each product
            $randomMaterials = array_rand($materialIds, $numberOfRelationshipsPerProduct);
            if (!is_array($randomMaterials)) {
                $randomMaterials = [$randomMaterials];
            }

            foreach ($randomMaterials as $materialIndex) {
                // Generate a random quantity between 1 and 10
                $quantity = rand(1, 10);
                
                DB::table('product_materials')->insert([
                    'product_id' => $productId,
                    'material_id' => $materialIds[$materialIndex],
                    'quantity' => $quantity, // Insert the random quantity
                ]);
            }
        }
    }
}