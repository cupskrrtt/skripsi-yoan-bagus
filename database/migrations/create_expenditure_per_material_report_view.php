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
        DB::statement("CREATE OR REPLACE VIEW expenditure_per_material_report_view AS
                        SELECT
                            mat.id,
                            mat.name,
                            SUM(mat.purchase_price * api.quantity) as amount,
                            (YEAR(apt.created_at) * 100) + MONTH(apt.created_at) as purchase_period,
                            DATE_FORMAT(apt.created_at, '%M %Y') AS purchase_period2
                        FROM
                            archive_purchase_transactions apt
                        JOIN
                            archive_purchase_items api
                        ON
                            apt.id = api.transaction_id
                        JOIN
                            materials mat
                        ON
                            api.material_id = mat.id
                        GROUP BY
                            (YEAR(apt.created_at) * 100) + MONTH(apt.created_at), mat.id, mat.name, apt.created_at
                        ORDER BY
                            purchase_period ASC");
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
