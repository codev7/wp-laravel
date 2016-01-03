<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MergeConciergeSitesTableWithProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->json('saved_credentials')->nullable()->default(null);
            $table->string('project_type')->after('id')->default('project')->index();
            $table->string('url')->after('name')->nullable()->default(null);
        });

        Schema::table('projects', function(Blueprint $table) {
            $table->dropColumn('files');
        });

        Schema::drop('concierge_sites');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function(Blueprint $table) {
            $table->dropColumn(['saved_credentials', 'project_type', 'url']);
        });

        Schema::table('projects', function(Blueprint $table) {
            $table->json('files')->nullable()->default(null);
        });

        Schema::create('concierge_sites', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');

            $table->integer('developer_id')->unsigned()->nullable()->default(null);
            $table->integer('project_manager_id')->unsigned()->nullable()->default(null);
            $table->integer('bitbucket_slug')->nullable()->default(null);

            $table->string('git_url')->nullable()->default(null);

            $table->integer('team_id')->unsigned()->nullable()->default(null);

            $table->string('name')->nullable()->default(null);
            $table->string('slug')->unique();

            $table->string('url')->nullable()->default(null);

            $table->text('saved_credentials')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('subdomain')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
