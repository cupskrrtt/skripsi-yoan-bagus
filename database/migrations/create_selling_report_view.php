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
        // !! sementara di harcode ke AGUSTUS 2024 !! --> tambahin filter tahun/bulan nanti
        // buat table 'availability' untuk material_availability atau pindahkan logic-nya ke aplikasi kalo perlu
        // ganti ke format laravel kalo perlu
        // buat view/SP untuk report di bulan+tahun ini (current month+year) kalo perlu
        DB::statement("CREATE OR REPLACE VIEW selling_report_view AS
                        SELECT
                            pro.id AS product_id,
                            pro.name AS product_name,
                            DATE_FORMAT(asi.created_at, '%M %Y') AS selling_period,
                            SUM(asi.quantity) AS selling_total,
                            pro.stock AS product_stock,
                            CASE WHEN pro.stock <= 0
                                THEN 'Sold out'
                                ELSE 'Available'
                                END AS product_availability,
                            (YEAR(asi.created_at) * 100) + MONTH(asi.created_at) AS selling_period2
                        FROM
                            products pro
                        JOIN
                            archive_selling_items asi
                        ON
                            pro.id = asi.product_id
                        WHERE
                            asi.created_at >= '20240801'
                        AND
                            asi.created_at < '20240901'
                        GROUP BY
                            pro.id, pro.name, (YEAR(asi.created_at) * 100) + MONTH(asi.created_at), pro.stock, DATE_FORMAT(asi.created_at, '%M %Y')
                        ORDER BY
                            selling_period2 DESC, product_name ASC");
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
