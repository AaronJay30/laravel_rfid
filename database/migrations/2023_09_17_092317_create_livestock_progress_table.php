<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('livestock_progress', function (Blueprint $table) {
            $table->bigIncrements('PID');
            $table->double('weight')->nullable();
            $table->double('length')->nullable();
            $table->double('wither')->nullable();
            $table->date('date')->nullable();
            $table->string('image', 255)->nullable();
            $table->unsignedBigInteger('RFID_TAG')->nullable();

            $table->foreign('RFID_TAG')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_progress');
    }
};
