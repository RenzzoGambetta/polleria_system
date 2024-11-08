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
        Schema::create('combo_item_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combo_id');
            $table->foreign('combo_id')->references('id')->on('menu_items');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('menu_items');
            $table->unsignedTinyInteger('item_quantity');
            $table->timestamps();
            $table->unique(['combo_id', 'item_id'], 'unique_combo_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combo_item_details');
    }
};
