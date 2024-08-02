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
        Schema::create('breed_kid_birth', function (Blueprint $table) {
            $table->bigIncrements('KID_ID');
            $table->date('kid_birth_date')->nullable();
            $table->double('kid_weight')->nullable();
            $table->double('kid_length')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breed_kid_birth');
    }
};
