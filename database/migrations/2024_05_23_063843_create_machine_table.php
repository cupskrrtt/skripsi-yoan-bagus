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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('use_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('use_id')->references('id')->on('machine_uses');
            $table->foreign('status_id')->references('id')->on('machine_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
