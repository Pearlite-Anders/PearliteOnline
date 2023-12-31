<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ignore foreign key constraints
        Schema::disableForeignKeyConstraints();

        Schema::drop('teams');
        Schema::drop('team_user');
        Schema::drop('team_invitations');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('current_team_id');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
