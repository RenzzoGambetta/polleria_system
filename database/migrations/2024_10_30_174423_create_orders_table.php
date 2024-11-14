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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('table_id')->nullable();
            $table->foreign('table_id')->references('id')->on('tables');
            $table->unsignedBigInteger('cashier_session_id');
            $table->foreign('cashier_session_id')->references('id')->on('cashier_sessions');
            $table->unsignedBigInteger('waiter_id');
            $table->foreign('waiter_id')->references('id')->on('users');
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->decimal('total_amount', 8 ,2)->nullable();
            $table->enum('status', ['pendiente', 'preparacion', 'terminado', 'en espera', 'pagado', 'completado', 'cancelado', 'reembolsado'])->default('pendiente');
            $table->boolean('is_delibery')->default(false);
            $table->string('commentary', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
