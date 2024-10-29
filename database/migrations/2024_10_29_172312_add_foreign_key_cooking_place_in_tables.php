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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->unsignedBigInteger('cooking_place_id')->after('category_id');
            $table->foreign('cooking_place_id')->references('id')->on('cooking_places');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedBigInteger('cooking_place_id')->after('id');
            $table->foreign('cooking_place_id')->references('id')->on('cooking_places');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('cooking_place_id');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('cooking_place_id');
        });
    }
};
