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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('menu_item_id');
            $table->foreign('menu_item_id')->references('id')->on('menu_items');
            $table->decimal('price', 8, 2);
            $table->tinyInteger('quantity')->default(1);
            $table->decimal('total_amount', 8 ,2);
            $table->enum('status', ['pendiente', 'preparacion', 'terminado', 'en espera', 'cancelado'])->default('pendiente');
            $table->boolean('is_delibery')->default(false);
            $table->string('note', 100)->nullable();
            $table->timestamps();
            $table->unique(['order_id', 'menu_item_id'], 'unique_order_menu_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
