<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SellingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('archive_selling_transactions')->insert([
            // @AR, start
            [
                'customer_id' => 1,
                'total' => 10000,
                'paid' => 10000,
                'payment_id' => 1,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
            ],
            [
                'customer_id' => 2,
                'total' => 20000,
                'paid' => 20000,
                'payment_id' => 2,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            [
                'customer_id' => 3,
                'total' => 20000,
                'paid' => 15000,
                'payment_id' => 4,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            // @AR, end
            [
                'customer_id' => 1,
                'total' => 1000,
                'paid' => 1000,
                'payment_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'total' => 2000,
                'paid' => 2000,
                'payment_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 3,
                'total' => 2000,
                'paid' => 1500,
                'payment_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
