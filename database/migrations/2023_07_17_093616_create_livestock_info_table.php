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
        Schema::create('livestock_info', function (Blueprint $table) {
            $table->bigIncrements('IID');
            $table->string('given_name', 45);
            $table->string('farm_name', 45);
            $table->string('sex', 45);
            $table->string('breed', 45);
            $table->bigInteger('sire')->nullable();
            $table->bigInteger('dam')->nullable();
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            $table->date('sold_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livestock_info');
    }
};
