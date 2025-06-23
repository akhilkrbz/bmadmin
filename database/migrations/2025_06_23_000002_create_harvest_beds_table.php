<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('harvest_beds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('harvest_id')->nullable();
            $table->unsignedInteger('bed_id')->nullable();
            $table->foreign('harvest_id')->references('id')->on('harvest')->onDelete('set null');
            $table->foreign('bed_id')->references('id')->on('beds')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harvest_beds');
    }
};
