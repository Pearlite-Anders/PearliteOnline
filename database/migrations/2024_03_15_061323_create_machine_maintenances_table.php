<?php

use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('machine_maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->json('data');
            $table->json('images')->nullable();
            $table->json('files')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Permission::create(['name' => 'machine-maintenance.view']);
        Permission::create(['name' => 'machine-maintenance.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_maintenances');
    }
};
