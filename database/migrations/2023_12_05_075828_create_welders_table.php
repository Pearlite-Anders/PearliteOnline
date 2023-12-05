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
        Schema::create('welders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Permission::create(['name' => 'welder.view']);
        Permission::create(['name' => 'welder.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welders');
    }
};
