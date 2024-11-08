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
        Schema::create('lounges', function (Blueprint $table) {
            $table->id();
            $table->char('code', 4)->unique();
            $table->string('name', 75);
            $table->unsignedTinyInteger('floor');
            $table->string('address', 255);
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('lounge_id')->nullable()->after('id');
            $table->foreign('lounge_id')->references('id')->on('lounges');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lounges');

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign(['lounge_id']);
            $table->dropColumn('lounge_id');
        });
    }
};
