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
        Schema::create('ces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->integer('current_file_id')->nullable();
            $table->json('data')->nullable();
            $table->json('previous_files')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Permission::create(['name' => 'ce.view']);
        Permission::create(['name' => 'ce.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_e_s');
    }
};
