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
       Schema::table('work_orders', function (Blueprint $table) {
            // Drop the bad FK that points to users
            $table->dropForeign('work_orders_technician_id_foreign'); // name from your error

            // Ensure the column allows NULL (since your form supports “Unassigned”)
            // If it’s already nullable, this is harmless.
            // If you get a "change() needs DBAL" error, skip this line.
            $table->unsignedBigInteger('technician_id')->nullable()->change();

            // Recreate FK to technicians
            $table->foreign('technician_id')
                  ->references('id')->on('technicians')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign(['technician_id']);
            $table->foreign('technician_id')
                  ->references('id')->on('users')
                  ->nullOnDelete();
        });
    }
};
