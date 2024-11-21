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
        // !! sementara di harcode ke tahun 2024 !! --> tambahin filter tahun/bulan nanti
        // banyak kolom yang belom dicek
        // ganti ke format laravel kalo perlu
        DB::statement("CREATE OR REPLACE VIEW profit_report_view AS
                        SELECT
                            (YEAR(ast.created_at) * 100) + MONTH(ast.created_at) AS 'period',
                            'selling' AS 'action',
                            SUM((pro.selling_price - pro.purchase_price) * asi.quantity) AS 'amount'
                        FROM
                            archive_selling_transactions ast
                        JOIN
                            archive_selling_items asi
                        ON
                            ast.id = asi.transaction_id
                        JOIN
                            products pro
                        ON
                            asi.product_id = pro.id
                        WHERE
                            ast.created_at >= '20240101'
                        AND
                            ast.created_at < '20250101'
                        GROUP BY
                            (YEAR(ast.created_at) * 100) + MONTH(ast.created_at)

                        UNION ALL

                        SELECT
                            (YEAR(apt.created_at) * 100) + MONTH(apt.created_at),
                            'purchase',
                            SUM(mat.purchase_price * api.quantity) * -1
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
                        WHERE
                            apt.created_at >= '20240101'
                        AND
                            apt.created_at < '20250101'
                        GROUP BY
                            (YEAR(apt.created_at) * 100) + MONTH(apt.created_at)
                        ORDER BY
                            period ASC, action ASC");
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
