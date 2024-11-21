<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectStatus;


class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectstatuses = ['Scheduled', 'Modeling','Cutting', 'Sewing', 'Finishing', 'Packing', 'Finish'];

        foreach ($projectstatuses as $projectstatus) {
            ProjectStatus::create(['name' => $projectstatus]);
        }
    }
}
