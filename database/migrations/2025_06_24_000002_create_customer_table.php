<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['shop', 'customer'])->nullable();
            $table->string('name', 200)->nullable();
            $table->string('place', 200)->nullable();
            $table->string('phone', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
