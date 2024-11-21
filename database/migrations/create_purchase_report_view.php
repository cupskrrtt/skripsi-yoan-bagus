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
        DB::statement("CREATE OR REPLACE VIEW purchase_report_view AS
                        SELECT
                            mat.id AS material_id,
                            mat.name AS material_name,
                            DATE_FORMAT(api.created_at, '%M %Y') AS purchase_period,
                            SUM(api.quantity) AS purchase_total,
                            mat.stock AS material_stock,
                            CASE WHEN mat.stock <= 0
                                THEN 'Out of stock'
                                ELSE 'Available'
                                END AS material_availability,
                            (YEAR(api.created_at) * 100) + MONTH(api.created_at) AS purchase_period2
                        FROM
                            materials mat
                        JOIN
                            archive_purchase_items api
                        ON
                            mat.id = api.material_id
                        WHERE
                            api.created_at >= '20240801'
                        AND
                            api.created_at < '20240901'
                        GROUP BY
                            mat.id, mat.name, (YEAR(api.created_at) * 100) + MONTH(api.created_at), mat.stock, DATE_FORMAT(api.created_at, '%M %Y')
                        ORDER BY
                            purchase_period2 DESC, material_name ASC");
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
