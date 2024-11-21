<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MachineUse;


class MachineUseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uses = ['Potong', 'Jahit', 'Setrika'];

        foreach ($uses as $use) {
            MachineUse::create(['name' => $use]);
        }
    }
}
