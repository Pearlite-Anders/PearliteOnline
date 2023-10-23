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
        Permission::create(['name' => 'welding-certificates.view']);
        Permission::create(['name' => 'welding-certificates.edit']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
