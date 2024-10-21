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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lounge_id');
            $table->foreign('lounge_id')->references('id')->on('lounges');
            $table->char('code', 4);
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->unique(['lounge_id', 'code'], 'unique_code_lounge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
