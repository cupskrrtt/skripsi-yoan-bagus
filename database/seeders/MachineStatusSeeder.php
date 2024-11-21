<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MachineStatus;


class MachineStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Baik', 'Digunakan', 'Rusak'];

        foreach ($statuses as $status) {
            MachineStatus::create(['name' => $status]);
        }
    }
}
