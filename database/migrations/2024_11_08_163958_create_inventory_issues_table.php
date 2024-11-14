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
        Schema::create('inventory_issues', function (Blueprint $table) {
            $table->id();
            $table->date('outgoing_date');
            $table->string('reason', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('inventory_movement_details', function (Blueprint $table) {
            $table->unsignedBigInteger('issue_id')->nullable()->after('receipt_id');
            $table->foreign('issue_id')->references('id')->on('inventory_issues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory_movement_details', function (Blueprint $table) {
            $table->dropForeign(['issue_id']);
            $table->dropColumn('issue_id');
        });

        Schema::dropIfExists('inventory_issues');
    }
};
