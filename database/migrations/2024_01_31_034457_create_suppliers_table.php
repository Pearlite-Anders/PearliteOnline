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
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->integer('current_file_id')->nullable();
            $table->foreignId('responsible_user_id')->nullable()->constrained('users');
            $table->foreignId('company_id')->constrained();
            $table->json('data');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('supplier_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained();
            $table->integer('current_file_id')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->json('data');
            $table->softDeletes();
            $table->timestamps();
        });

        Permission::create(['name' => 'supplier.view']);
        Permission::create(['name' => 'supplier.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
