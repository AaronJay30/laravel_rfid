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
        Schema::create('livestock_char', function (Blueprint $table) {
            $table->bigIncrements('CID');
            $table->string('jaw', 20);
            $table->string('ear', 20);
            $table->string('body', 20);
            $table->string('teat', 20);
            $table->string('horn', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_char');
    }
};
