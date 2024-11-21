<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('archive_purchase_transactions')->insert([
            // @AR, start
            [
                'supplier_id' => 1,
                'total' => 981000,
                'paid' => 981000,
                'payment_id' => 1,
                'discount' => 2.5,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
            ],
            [
                'supplier_id' => 2,
                'total' => 542000,
                'paid' => 542000,
                'payment_id' => 2,
                'discount' => 5,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            [
                'supplier_id' => 3,
                'total' => 212000,
                'paid' => 211500,
                'payment_id' => 4,
                'discount' => 7.5,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            // @AR, end
            [
                'supplier_id' => 1,
                'total' => 1000,
                'paid' => 1000,
                'payment_id' => 1,
                'discount' => 2.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 2,
                'total' => 2000,
                'paid' => 2000,
                'payment_id' => 2,
                'discount' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 3,
                'total' => 2000,
                'paid' => 1500,
                'payment_id' => 4,
                'discount' => 7.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
