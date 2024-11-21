<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['DAD', 'KIDS', 'MOM'];

        foreach ($types as $type) {
            Type::create(['name' => $type]);
        }
    }
}
