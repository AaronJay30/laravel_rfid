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
        Schema::create('breed_details', function (Blueprint $table) {
            $table->bigIncrements('BID');
            $table->string('breed_type', 20)->nullable();
            $table->unsignedBigInteger('dam_id')->nullable();
            $table->unsignedBigInteger('sire_id')->nullable();
            $table->integer('dam_breed_count')->nullable();
            $table->integer('sire_breed_count')->nullable();
            $table->date('breed_date')->nullable();
            
            $table->foreign('dam_id')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sire_id')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breed_details');
    }
};
