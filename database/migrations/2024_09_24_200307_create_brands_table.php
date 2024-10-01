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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name', 50)->unique();
            $table->string('description', 255)->nullable();
=======
            $table->string('name', 50);
            $table->string('description', 255)->default(null)->nullable();
>>>>>>> 6b50f5a (implementacion de migraciones y fabricas de los modelos marca, proveedor e insumo)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
