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
        Schema::create('forage_reg', function (Blueprint $table) {
            $table->increments('FID')->unsigned();
            $table->unsignedBigInteger('FEED_ID')->nullable();
            $table->unsignedBigInteger('EST_ID')->nullable();
            $table->unsignedBigInteger('RFID_TAG')->nullable();
            $table->timestamps();

            $table->foreign('FEED_ID')->references('FEED_ID')->on('forage_info')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('EST_ID')->references('EST_ID')->on('forage_est')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('RFID_TAG')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forage_reg');
    }
};
