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
        Schema::create('wpqrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->integer('current_file_id')->nullable();
            $table->json('data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Permission::create(['name' => 'wpqr.view']);
        Permission::create(['name' => 'wpqr.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wpqrs');
    }
};
