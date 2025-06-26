<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['direct', 'indirect', 'customer', 'shop', 'supplier'])->default('direct');
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
