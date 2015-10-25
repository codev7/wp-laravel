<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->json('files')->nullable()->default(null);
            $table->integer('project_type_id');
            $table->integer('developer_id')->nullable()->default(null);
            $table->integer('project_manager_id')->nullable()->default(null);
            $table->string('git_url')->nullable()->default(null);
            $table->integer('bitbucket_id')->nullable()->default(null);
            $table->integer('team_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('requested_deadline')->nullable()->default(null);
            $table->date('guaranteed_deadline')->nullable()->default(null);
            $table->string('status');
            $table->string('subdomain')->nullable()->default(null);
            $table->json('contractor_payout')->nullable()->default(null);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
