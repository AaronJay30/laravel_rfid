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
        Schema::create('forage_info', function (Blueprint $table) {
            $table->bigIncrements('FEED_ID');
            $table->string('forage_type', 20)->nullable();
            $table->decimal('dry_matter')->nullable();
            $table->double('feed_intake')->nullable();
            $table->date('duration_start')->nullable();
            $table->date('duration_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forage_info');
    }
};
