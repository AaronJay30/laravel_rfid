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
        Schema::create('breed_reg', function (Blueprint $table) {
            $table->unsignedBigInteger('BID')->nullable();
            $table->unsignedBigInteger('KID_ID')->nullable();
            $table->timestamps();

            $table->foreign('BID')->references('BID')->on('breed_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('KID_ID')->references('KID_ID')->on('breed_kid_birth')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breed_reg');
    }
};
