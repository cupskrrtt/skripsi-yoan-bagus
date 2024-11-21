<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaterialCategory;


class MaterialCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Benang', 'Aksesoris', 'Kain', 'Kancing', 'Resleting'];

        foreach ($categories as $category) {
            MaterialCategory::create(['name' => $category]);
        }
    }
}
