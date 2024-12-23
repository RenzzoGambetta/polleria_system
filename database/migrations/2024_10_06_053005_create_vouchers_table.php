<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_serie_id');
            $table->foreign('voucher_serie_id')->references('id')->on('voucher_series');
            $table->unsignedInteger('correlative_number');
            $table->date('issuance_date');
            $table->date('expiration_date')->nullable();
            $table->decimal('total_amount', 8 ,2)->default(0.0);
            $table->enum('payment_type', ['contado', 'credito'])->default('contado');
            $table->enum('status', ['pagado', 'anulado', 'reembolsado'])->default('pagado');
            $table->string('commentary', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
