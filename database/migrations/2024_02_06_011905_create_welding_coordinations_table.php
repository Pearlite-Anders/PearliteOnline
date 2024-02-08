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
        Schema::create('welding_coordinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('project_id')->constrained()->nullable();
            $table->json('data');
            $table->json('files')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Permission::create(['name' => 'welding_coordination.view']);
        Permission::create(['name' => 'welding_coordination.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welding_coordinations');
    }
};
