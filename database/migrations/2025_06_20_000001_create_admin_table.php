<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('password', 200)->nullable();
            $table->integer('status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
