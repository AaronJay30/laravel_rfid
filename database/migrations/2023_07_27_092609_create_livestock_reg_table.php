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
        Schema::create('livestock_reg', function (Blueprint $table) {
            $table->bigIncrements('RFID_TAG')->unsigned();
            $table->unsignedBigInteger('IID')->unique()->nullable();
            $table->unsignedBigInteger('CID')->unique()->nullable();
            $table->unsignedBigInteger('BID')->unique()->nullable();
            $table->timestamps();

            $table->foreign('BID')->references('BID')->on('livestock_birthinfo')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('CID')->references('CID')->on('livestock_char')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('IID')->references('IID')->on('livestock_info')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_reg');
    }
};
