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
        Schema::create('machine_maintenance_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_maintenance_id')->constrained();
            $table->integer('current_file_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->json('data');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_maintenance_maintenances');
    }
};
