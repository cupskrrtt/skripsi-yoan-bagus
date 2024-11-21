<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SellingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('archive_selling_items')->insert([
            // @AR, start
            [
                'transaction_id' => 1,
                'product_id' => 1,
                'quantity' => 10,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-2 month")),
            ],
            [
                'transaction_id' => 2,
                'product_id' => 2,
                'quantity' => 20,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            [
                'transaction_id' => 3,
                'product_id' => 3,
                'quantity' => 30,
                'created_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
                'updated_at' => date_add(now(), date_interval_create_from_date_string("-1 month")),
            ],
            // @AR, end
            [
                // @AR, start
                //'transaction_id' => 1,
                'transaction_id' => 4,
                // @AR, end
                'product_id' => 1,
                'quantity' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // @AR, start
                //'transaction_id' => 1,
                'transaction_id' => 5,
                // @AR, end
                'product_id' => 2,
                'quantity' => 62,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                // @AR, start
                //'transaction_id' => 1,
                'transaction_id' => 6,
                // @AR, end
                'product_id' => 3,
                'quantity' => 31,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
