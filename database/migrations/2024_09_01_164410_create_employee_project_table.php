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
        Schema::create('Employee_Project', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_employee');
            $table->unsignedBigInteger('ID_Project');
            $table->string('Pegawai')->nullable();
            $table->string('project')->nullable();
            $table->string('Description')->nullable();
    
            $table->primary(['ID_employee', 'ID_Project']);
    
            // Foreign keys
            $table->foreign('ID_employee')->references('ID')->on('employee')->onDelete('cascade');
            $table->foreign('ID_Project')->references('ID')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employee_Project');
    }
};
