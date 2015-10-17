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
            $table->integer('html_developer_id')->nullable()->default(null);
            $table->integer('javascript_developer_id')->nullable()->default(null);
            $table->integer('qa_engineer_id')->nullable()->default(null);
            $table->integer('wordpress_developer_id')->nullable()->default(null);
            $table->string('git_url')->nullable()->default(null);
            $table->integer('lead_id')->nullable()->default(null);
            $table->integer('customer_id');
            $table->string('title');
            $table->string('deadline')->nullable()->default(null);
            $table->string('status');
            $table->string('subdomain')->unique();
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
