<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaterialUnit;


class MaterialUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = ['Roll', 'Meter', 'Piece', 'Pack'];

        foreach ($units as $unit) {
            MaterialUnit::create(['name' => $unit]);
        }
    }
}
