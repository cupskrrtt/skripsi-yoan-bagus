<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('archive_purchase_items')->insert([
            // @AR, start
            [
                'transaction_id' => 1,
                'material_id' => 1,
                'quantity' => 41,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
            ],
            [
                'transaction_id' => 2,
                'material_id' => 2,
                'quantity' => 24,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            [
                'transaction_id' => 3,
                'material_id' => 3,
                'quantity' => 10,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            // @AR, end
            [
                // @AR, start
                //'transaction_id' => 1,
                'transaction_id' => 4,
                // @AR, end
                'material_id' => 1,
                'quantity' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // @AR, start
                //'transaction_id' => 1,
                'transaction_id' => 5,
                // @AR, end
                'material_id' => 2,
                'quantity' => 62,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // @AR, start
                //'transaction_id' => 1,
                'transaction_id' => 6,
                // @AR, end
                'material_id' => 3,
                'quantity' => 31,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
