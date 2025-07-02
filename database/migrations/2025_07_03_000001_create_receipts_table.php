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
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('receipt_number', 20)->nullable();
            $table->date('receipt_date')->nullable();
            $table->unsignedInteger('ledger_id')->nullable();
            $table->double('amount')->nullable();
            $table->enum('payment_mode', ['cash', 'bank'])->default('cash');
            $table->text('description')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->foreign('ledger_id')->references('id')->on('ledgers')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
