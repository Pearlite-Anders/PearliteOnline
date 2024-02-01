<?php

use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->json('data');
            $table->softDeletes();
            $table->timestamps();
        });

        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


        Permission::create(['name' => 'project.view']);
        Permission::create(['name' => 'project.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
