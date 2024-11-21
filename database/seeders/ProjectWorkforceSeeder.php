<?php
// @AR2, start

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ProjectWorkforce;

class ProjectWorkforceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectWorkforce::create([
            'project_id' => 1,
            'workforce_id' => 1,
            'date' => now(),
            'task' => 'Contoh 11',
        ]);

        ProjectWorkforce::create([
            'project_id' => 1,
            'workforce_id' => 4,
            'date' => now(),
            'task' => 'Contoh 21',
        ]);

        ProjectWorkforce::create([
            'project_id' => 1,
            'workforce_id' => 4,
            'date' => now(),
            'task' => 'Contoh 22',
        ]);

        ProjectWorkforce::create([
            'project_id' => 2,
            'workforce_id' => 2,
            'date' => now(),
            'task' => 'Contoh 31',
        ]);

        ProjectWorkforce::create([
            'project_id' => 2,
            'workforce_id' => 4,
            'date' => now(),
            'task' => 'Contoh 41',
        ]);

        ProjectWorkforce::create([
            'project_id' => 3,
            'workforce_id' => 1,
            'date' => now(),
            'task' => 'Contoh 51',
        ]);
    }
}
// @AR2, end
