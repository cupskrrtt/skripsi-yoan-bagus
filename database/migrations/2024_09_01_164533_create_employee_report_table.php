<?php

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
        Schema::create('employee_report', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_employee');
            $table->unsignedBigInteger('ID_project');
            $table->date('Date');
            $table->text('Report');
    
            $table->primary(['ID_employee', 'ID_project', 'Date']);
    
            // Foreign keys
            $table->foreign('ID_employee')->references('ID')->on('employee')->onDelete('cascade');
            $table->foreign('ID_project')->references('ID')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_report');
    }
};
