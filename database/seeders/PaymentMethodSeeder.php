<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payments = ['Cash', 'Transfer', 'QRIS', 'Hutang'];

        foreach ($payments as $payment) {
            PaymentMethod::create(['name' => $payment]);
        }
    }
}
