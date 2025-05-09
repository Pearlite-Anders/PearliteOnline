<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->json('files')->nullable();
            $table->foreignId('company_id')->nullable()->constrained();
            $table->foreignId('owner_id')->constrained(
                table: 'users'
            );

            $table->softDeletes();
            $table->timestamps();
        });

        try {
            Permission::create(['name' => 'document.view']);
            Permission::create(['name' => 'document.edit']);
        } catch (Spatie\Permission\Exceptions\PermissionAlreadyExists $e) {
            // Permission allready exsists, so do nothing
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
