<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Machine;
use App\Models\MachineUse;
use App\Models\MachineStatus;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uses = MachineUse::pluck('id')->toArray();
        $statuses = MachineStatus::pluck('id')->toArray();

        Machine::create([
            'name' => 'Potong 1',
            'use_id' => $uses[array_rand($uses)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);

        Machine::create([
            'name' => 'Jahit 1',
            'use_id' => $uses[array_rand($uses)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);

        Machine::create([
            'name' => 'Jahit 2',
            'use_id' => $uses[array_rand($uses)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);

        Machine::create([
            'name' => 'Jahit 3',
            'use_id' => $uses[array_rand($uses)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);
        Machine::create([
            'name' => 'Setrika 1',
            'use_id' => $uses[array_rand($uses)],
            'status_id' => $statuses[array_rand($statuses)],
        ]);
    }
}
