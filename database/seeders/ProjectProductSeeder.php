<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\DB;


class ProjectProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define sample product and product IDs
        $projectIds = Project::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        // Define the number of relationships you want to create for each product
        $numberOfRelationshipsPerProduct = 2;

        // Create sample relationships between products and products
        foreach ($projectIds as $projectId) {
            // Shuffle the product IDs to get random products for each product
            $randomProducts = array_rand($productIds, $numberOfRelationshipsPerProduct);
            if (!is_array($randomProducts)) {
                $randomProducts = [$randomProducts];
            }

            foreach ($randomProducts as $productIndex) {
                // Generate a random quantity between 1 and 10
                $quantity = rand(1, 10);
                
                DB::table('project_products')->insert([
                    'project_id' => $projectId,
                    'product_id' => $productIds[$productIndex],
                    'quantity' => $quantity, // Insert the random quantity
                ]);
            }
        }
    }
}
