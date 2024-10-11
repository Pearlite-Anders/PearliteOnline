<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('data');
            $table->dropColumn('files');
        });
        Schema::create('document_revisions', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->json('files')->nullable();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->json('data');
            $table->json('files')->nullable();
        });
        Schema::dropIfExists('document_revisions');
    }
};
