<?php
// @AR, start
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ganti ke format laravel kalo perlu
        DB::statement("CREATE OR REPLACE VIEW all_time_selling_report_view AS
                        SELECT
                            pro.id AS product_id,
                            pro.name AS product_name,
                            SUM(asi.quantity) AS selling_total
                        FROM
                            products pro
                        JOIN
                            archive_selling_items asi
                        ON
                            pro.id = asi.product_id
                        GROUP BY
                            pro.id, pro.name
                        ORDER BY
                            product_name ASC");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tambahin buat drop View nya nanti
    }
};
// @AR, end
