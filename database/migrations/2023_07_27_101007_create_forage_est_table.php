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
        Schema::create('forage_est', function (Blueprint $table) {
            $table->bigIncrements('EST_ID');
            $table->string('est', 60)->nullable();
            $table->string('est_status', 60)->nullable();
            $table->string('soil_type', 60)->nullable();
            $table->string('forage_type', 60)->nullable();
            $table->string('climate_condition', 60)->nullable();
            $table->date('date_planted')->nullable();
            $table->date('date_harvested')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forage_est');
    }
};
