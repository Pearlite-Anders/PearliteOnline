<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_wpqr', function (Blueprint $table) {
            $table->foreignId('wpqr_id')->constrained();
            $table->foreignId('project_id')->constrained();
        });

        Schema::create('project_welding_certificate', function (Blueprint $table) {
            $table->foreignId('welding_certificate_id')->constrained();
            $table->foreignId('project_id')->constrained();
        });

        Schema::create('project_welder', function (Blueprint $table) {
            $table->foreignId('welder_id')->constrained();
            $table->foreignId('project_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
