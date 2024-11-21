<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\MaterialUnit;
use App\Models\MaterialCategory;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = MaterialCategory::pluck('id')->toArray();
        $units = MaterialUnit::pluck('id')->toArray();

        Material::create([
            'name' => 'Kancing merah',
            'stock' => '50',
            'unit_id' => $units[array_rand($units)],
            'category_id' => $categories[array_rand($categories)],
            'code' => 'KCGMR01',
            'purchase_price' => 1000,
            'stock' => 200,
        ]);

        Material::create([
            'name' => 'Resleting pink',
            'stock' => '50',
            'unit_id' => $units[array_rand($units)],
            'category_id' => $categories[array_rand($categories)],
            'code' => 'RLTPN01',
            'purchase_price' => 1500,
            'stock' => 100,
        ]);

        Material::create([
            'name' => 'Benang putih',
            'stock' => '50',
            'unit_id' => $units[array_rand($units)],
            'category_id' => $categories[array_rand($categories)],
            'code' => 'BNGPT01',
            'purchase_price' => 5000,
            'stock' => 25,
        ]);

        Material::create([
            'name' => 'Benang merah',
            'stock' => '50',
            'unit_id' => $units[array_rand($units)],
            'category_id' => $categories[array_rand($categories)],
            'code' => 'BNGMR01',
            'purchase_price' => 10000,
            'stock' => 35,
        ]);
        Material::create([
            'name' => 'Kain merah',
            'stock' => '50',
            'unit_id' => $units[array_rand($units)],
            'category_id' => $categories[array_rand($categories)],
            'code' => 'KAIN01',
            'purchase_price' => 15000,
            'stock' => 35,
        ]);
    }
}