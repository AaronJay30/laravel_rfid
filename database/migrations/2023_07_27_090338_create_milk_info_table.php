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
        Schema::create('milk_info', function (Blueprint $table) {
            $table->bigIncrements('MILK_MID');
            $table->double('milk_yield')->nullable();
            $table->string('milking_time', 20)->nullable();
            $table->double('milk_temp')->nullable();
            $table->string('milk_quality', 20)->nullable();
            $table->string('milk_fat', 20)->nullable();
            $table->string('milk_protein', 20)->nullable();
            $table->string('milker_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_info');
    }
};
