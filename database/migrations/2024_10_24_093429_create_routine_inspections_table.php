<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('routine_inspections', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->foreignId('company_id')->nullable()->constrained();
            $table->foreignId('wps_id')->nullable()->constrained();
            $table->foreignId('project_id')->nullable()->constrained();
            $table->foreignId('welder_id')->nullable()->constrained();
            $table->timestamps();

            try {
                Permission::create(['name' => 'routine_inspections.view']);
                Permission::create(['name' => 'routine_inspections.edit']);
            } catch (Spatie\Permission\Exceptions\PermissionAlreadyExists $e) {
                // Permission allready exsists, so do nothing
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routine_inspections');
    }
};
