<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->date('purchase_date')->nullable();
            $table->string('bill_no', 200)->nullable();
            $table->unsignedInteger('supplier_id')->nullable();
            $table->enum('payment_mode', ['cash', 'bank', 'credit'])->default('cash');
            $table->float('total_amount')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('supplier_id')->references('id')->on('ledgers')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
