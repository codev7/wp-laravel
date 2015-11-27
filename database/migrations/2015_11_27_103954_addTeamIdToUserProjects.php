<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTeamIdToUserProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_projects', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(['project_id', 'user_id']);
            $table->integer('team_id')->unsigned();
            $table->dropIndex('user_projects_user_id_project_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_projects', function(Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('team_id');
            $table->index(['user_id', 'project_id']);
        });

        Schema::table('user_projects', function(Blueprint $table) {
            $table->increments('id');
        });
    }
}
