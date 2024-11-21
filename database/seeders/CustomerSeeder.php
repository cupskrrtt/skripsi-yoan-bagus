<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'name' => 'Sengud',
                'class_id' => 1,
                'telp' => '0812-4567-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suryati',
                'class_id' => 2,
                'telp' => '0898-5765-4321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maryono',
                'class_id' => 3,
                'telp' => '0855-5555-5555',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
