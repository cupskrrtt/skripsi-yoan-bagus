<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerClass;


class CustomerClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_classes')->insert([
            [
                'name' => 'Retail',
                'discount' => 10.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gol A',
                'discount' => 20.0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gol B',
                'discount' => 25.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
