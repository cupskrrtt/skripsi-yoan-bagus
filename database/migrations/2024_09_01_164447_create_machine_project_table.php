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
        Schema::create('Machine_Project', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Machine');
            $table->unsignedBigInteger('ID_Project');
            $table->string('mesin')->nullable();
            $table->string('project')->nullable();
            $table->string('Description')->nullable();
    
            $table->primary(['ID_Machine', 'ID_Project']);
    
            // Foreign keys
            $table->foreign('ID_Machine')->references('ID')->on('machine')->onDelete('cascade');
            $table->foreign('ID_Project')->references('ID')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Machine_Project');
    }
};
