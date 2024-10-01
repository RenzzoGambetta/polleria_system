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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('code', 15)->nullable();
            $table->string('name', 100);
            $table->boolean('is_stockable')->default(false);
            $table->integer('stock')->default(0);
            $table->string('unit', 15)->default('uni');
            $table->string('note', 255)->nullable();
=======
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->string('code', 15);
            $table->string('name', 64);
            $table->boolean('is_stockable');
            $table->integer('stock');
            $table->string('unit', 15);
            $table->string('note', 255);
>>>>>>> 6b50f5a (implementacion de migraciones y fabricas de los modelos marca, proveedor e insumo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies');
    }
};
