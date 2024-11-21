<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectStatus;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectstatuses = ProjectStatus::pluck('id')->toArray();

        Project::create([
            'name' => 'Ramadhan 2024',
            'start_date' => '2024-03-03',
            'end_date' => '2024-03-13',
            'status_id' => $projectstatuses[array_rand($projectstatuses)],
        ]);
        Project::create([
            'name' => 'Ramadhan 2024 v2',
            'start_date' => '2024-03-05',
            'end_date' => '2024-03-20',
            'status_id' => $projectstatuses[array_rand($projectstatuses)],
        ]);
        Project::create([
            'name' => 'Pesanan Bu Minah',
            'start_date' => '2024-03-23',
            'end_date' => '2024-04-05',
            'status_id' => $projectstatuses[array_rand($projectstatuses)],
        ]);
        Project::create([
            'name' => 'Batch Kerudung Mei',
            'start_date' => '2024-04-03',
            'end_date' => '2024-04-13',
            'status_id' => $projectstatuses[array_rand($projectstatuses)],
        ]);
    }
}
