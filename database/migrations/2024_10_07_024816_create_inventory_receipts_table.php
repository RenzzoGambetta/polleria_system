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
        Schema::create('inventory_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->foreign('voucher_id')->references('id')->on('voucher_types');
            $table->string('voucher_serie', 4);
            $table->char('correlative_number', 8);
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->date('issuance_date');
            $table->date('expiration_date')->nullable();
            $table->decimal('total_amount', 8 ,2);
            $table->enum('payment_type', ['contado', 'credito'])->default('contado');
            $table->string('commentary', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_receipts');
    }
};
