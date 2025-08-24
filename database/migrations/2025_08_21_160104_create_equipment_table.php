<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('location');
            $table->string('status');
            $table->date('last_maintenance')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('equipment');
    }
};