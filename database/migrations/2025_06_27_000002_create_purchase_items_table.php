<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('purchase_id')->nullable();
            $table->unsignedInteger('item_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('rate')->nullable();
            $table->float('amount')->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('set null');
            $table->foreign('item_id')->references('id')->on('ledgers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
