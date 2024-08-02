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
        Schema::create('dead', function (Blueprint $table) {
            $table->bigIncrements('DEAD_ID');
            $table->string('remarks')->nullable();
            $table->string('death_cause')->nullable();
            $table->string('death_date')->nullable();
            $table->unsignedBigInteger('RFID_TAG')->nullable();

            $table->foreign('RFID_TAG')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dead');
    }
};
