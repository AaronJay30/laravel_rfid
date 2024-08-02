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
        Schema::create('buyer_info', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_address')->nullable();
            $table->string('buyer_contact')->nullable();
            $table->date('sold_date')->nullable();
            $table->string('sex')->nullable();
            $table->string('animal_weight')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('animal_value')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('RFID_TAG')->nullable();

            $table->foreign('RFID_TAG')->references('RFID_TAG')->on('livestock_reg')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_info');
    }
};
