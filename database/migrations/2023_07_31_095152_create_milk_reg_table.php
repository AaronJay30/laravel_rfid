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
        Schema::create('milk_reg', function (Blueprint $table) {
            $table->bigIncrements('MILK_ID');
            $table->unsignedBigInteger('MILK_MID')->nullable();
            $table->unsignedBigInteger('MILK_LID')->nullable();
            $table->unsignedBigInteger('RFID_TAG')->nullable();
            $table->date('milking_date')->nullable();

            $table->foreign('MILK_MID')->references('MILK_MID')->on('milk_info')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('MILK_LID')->references('MILK_LID')->on('milk_lactation')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('RFID_TAG')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_reg');
    }
};
