<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectBriefsTableAddApprovedByAdminCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_briefs', function(Blueprint $table) {
            $table->renameColumn('approved_at', 'approved_by_customer_at');
            $table->integer('approved_by_admin_id')->unsigned()->nullable()->default(null);
            $table->timestamp('approved_by_admin_at')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_briefs', function(Blueprint $table) {
            $table->renameColumn('approved_by_client_at', 'approved_at');
            $table->dropColumn('approved_by_admin_id', 'approved_by_admin_at');
        });
    }
}
