<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePTRelatedColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->string('pivotal_id')->nullable()->default(null);
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->string('pivotal_comment_id')->nullable()->default(null);
        });

        Schema::table('to_dos', function(Blueprint $table) {
            $table->bigInteger('bitbucket_issue_id')->nullable()->default(null)->change();
            $table->renameColumn('bitbucket_issue_id', 'pivotal_story_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->dropColumn('pivotal_id');
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->dropColumn('pivotal_comment_id');
        });

        Schema::table('to_dos', function(Blueprint $table) {
            $table->renameColumn('pivotal_story_id', 'bitbucket_issue_id');
        });
    }
}