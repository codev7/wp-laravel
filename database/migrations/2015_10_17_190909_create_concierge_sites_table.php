<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConciergeSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concierge_sites', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');

            $table->integer('developer_id')->unsigned()->nullable()->default(null);
            $table->integer('project_manager_id')->unsigned()->nullable()->default(null);
            $table->integer('bitbucket_id')->nullable()->default(null);

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('concierge_sites');
    }
}
