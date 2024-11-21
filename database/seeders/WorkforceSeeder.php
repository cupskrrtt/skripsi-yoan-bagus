<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Workforce;
use App\Models\WorkforceStatus;
use App\Models\WorkforcePosition;

class WorkforceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = WorkforcePosition::pluck('id')->toArray();
        $statuses = WorkforceStatus::pluck('id')->toArray();

        Workforce::create([
            'name' => 'Juan Meta',
            'position_id' => $positions[array_rand($positions)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);

        Workforce::create([
            'name' => 'Edwin Makarim',
            'position_id' => $positions[array_rand($positions)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);

        Workforce::create([
            'name' => 'Bagus Mahardika',
            'position_id' => $positions[array_rand($positions)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);

        Workforce::create([
            'name' => 'Yoandhika Surya',
            'position_id' => $positions[array_rand($positions)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);
    }
}
