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
        Schema::create('schedule', function (Blueprint $table) {
            $table->bigIncrements('SCHED_ID');
            $table->string('event', 30)->nullable();
            $table->string('medicine')->nullable();
            $table->string('treatment')->nullable();
            $table->string('symptoms')->nullable();
            $table->double('weight')->nullable();
            $table->double('temperature')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->nullable()->default('unfinished');
            $table->unsignedBigInteger('RFID_TAG')->nullable();

            $table->foreign('RFID_TAG')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
