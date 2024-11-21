<?php
// @AR2, start

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProjectMachine;

class ProjectMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectMachine::create([
            'project_id' => 1,
            'machine_id' => 2,
            'date' => now(),
            'task' => 'Contoh 1',
        ]);

        ProjectMachine::create([
            'project_id' => 1,
            'machine_id' => 3,
            'date' => now(),
            'task' => 'Contoh 2',
        ]);

        ProjectMachine::create([
            'project_id' => 2,
            'machine_id' => 1,
            'date' => now(),
            'task' => 'Contoh 3',
        ]);

        ProjectMachine::create([
            'project_id' => 2,
            'machine_id' => 4,
            'date' => now(),
            'task' => 'Contoh 4',
        ]);

        ProjectMachine::create([
            'project_id' => 3,
            'machine_id' => 2,
            'date' => now(),
            'task' => 'Contoh 5',
        ]);
    }
}
// @AR2, end
