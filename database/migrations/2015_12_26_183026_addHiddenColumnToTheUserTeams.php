<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHiddenColumnToTheUserTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_teams', function(Blueprint $table) {
            $table->boolean('hidden')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_teams', function(Blueprint $table) {
            $table->dropColumn('hidden');
        });
    }
}
