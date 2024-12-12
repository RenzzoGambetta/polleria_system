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
        Schema::create('order_series', function (Blueprint $table) {
            $table->id();
            $table->char('serie_number', 4)->unique();
            $table->unsignedInteger('last_correlative_number');
            $table->timestamps();
            $table->unique(['serie_number', 'last_correlative_number'], 'unique_order_serie_correlative_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_series');
    }
};
