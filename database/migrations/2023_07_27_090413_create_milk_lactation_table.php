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
        Schema::create('milk_lactation', function (Blueprint $table) {
            $table->bigIncrements('MILK_LID');
            $table->string('lact_season')->nullable();
            $table->date('lact_start')->nullable();
            $table->date('lact_end')->nullable();
            $table->string('lact_length')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_lactation');
    }
};
