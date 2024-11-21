<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkforcePosition;

class WorkforcePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = ['Tukang Potong', 'Tukang Jahit', 'Tukang Setrika', 'Tukang Packing'];

        foreach ($positions as $position) {
            WorkforcePosition::create(['name' => $position]);
        }
    }
}
