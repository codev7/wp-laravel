<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterConciergeSitesRenameBitbucketIdToBitbucketSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concierge_sites', function(Blueprint $table) {
            $table->string('bitbucket_id')->nullable()->default(null)->change();
            $table->renameColumn('bitbucket_id', 'bitbucket_slug');
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
            $table->integer('bitbucket_slug')->nullable()->default(null)->change();
            $table->renameColumn('bitbucket_slug', 'bitbucket_id');
        });
    }
}
