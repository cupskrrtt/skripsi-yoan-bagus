<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call each seeder class individually
        $this->call([
            CategorySeeder::class,
            ColorSeeder::class,
            SignSeeder::class,
            SizeSeeder::class,
            TypeSeeder::class,
            MaterialUnitSeeder::class,
            MaterialCategorySeeder::class,
            MaterialSeeder::class,
            MachineStatusSeeder::class,
            MachineUseSeeder::class,
            MachineSeeder::class,
            WorkforceStatusSeeder::class,
            WorkforcePositionSeeder::class,
            WorkforceSeeder::class,
            ProductSeeder::class,
            ProductMaterialSeeder::class,
            CreateUsersSeeder::class,
            ProjectStatusSeeder::class,
            ProjectSeeder::class,
            ProjectProductSeeder::class,
            CustomerClassSeeder::class,
            CustomerSeeder::class,
            SupplierClassSeeder::class,
            SupplierSeeder::class,
            PaymentMethodSeeder::class,
            SellingTransactionSeeder::class,
            SellingItemSeeder::class,
            PurchaseTransactionSeeder::class,
            PurchaseItemSeeder::class,

            CalculatePriceSeeder::class,
            // @AR2, start
            ProjectMachineSeeder::class,
            ProjectWorkforceSeeder::class,
            // @AR2, end

            // Add more seeders here if needed
        ]);
    }
}
