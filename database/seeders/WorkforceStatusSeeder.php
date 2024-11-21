<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkforceStatus;


class WorkforceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Masuk', 'Bolos', 'Izin', 'Sakit'];

        foreach ($statuses as $status) {
            WorkforceStatus::create(['name' => $status]);
        }
    }
}
