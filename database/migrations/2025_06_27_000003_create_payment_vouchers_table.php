<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_number', 20)->nullable();
            $table->date('voucher_date')->nullable();
            $table->enum('voucher_type', ['ledger', 'purchase'])->default('ledger');
            $table->unsignedInteger('voucher_type_id')->nullable();
            $table->float('amount')->nullable();
            $table->enum('payment_mode', ['cash', 'bank'])->default('cash');
            $table->text('description')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_vouchers');
    }
};
