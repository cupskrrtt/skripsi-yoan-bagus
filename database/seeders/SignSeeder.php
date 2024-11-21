<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sign;

class SignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signs = ['KAEN', 'EMKA', 'LUPA'];

        foreach ($signs as $sign) {
            Sign::create(['name' => $sign]);
        }
    }
}
