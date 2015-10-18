<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectBriefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_briefs', function (Blueprint $table) {
            $table->increments('id');

            $table->text('text');

            $table->integer('project_type_id')->unsigned()->nullable()->default(null);

            $table->integer('created_by_id')->unsigned();

            $table->integer('approved_by_customer_id')->unsigned()->nullable()->default(null);

            $table->timestamp('approved_at')->nullable()->default(null);

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
        Schema::drop('project_briefs');
    }
}
