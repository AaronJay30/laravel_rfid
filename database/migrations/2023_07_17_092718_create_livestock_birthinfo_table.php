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
        Schema::create('livestock_birthinfo', function (Blueprint $table) {
            $table->bigIncrements('BID');
            $table->date('birth_date');
            $table->string('birth_season', 20);
            $table->string('birth_type', 20);
            $table->string('milk_type', 20);
            $table->string('birth_image', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_birthinfo');
    }
};
