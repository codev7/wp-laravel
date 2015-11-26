<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BitbucketSlugTypeChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concierge_sites', function(Blueprint $table) {
            $table->string('bitbucket_slug')->change();
        });
        Schema::table('projects', function(Blueprint $table) {
            $table->string('bitbucket_slug')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concierge_sites', function(Blueprint $table) {
            $table->integer('bitbucket_slug')->change();
        });
        Schema::table('projects', function(Blueprint $table) {
            $table->integer('bitbucket_slug')->change();
        });
    }
}
