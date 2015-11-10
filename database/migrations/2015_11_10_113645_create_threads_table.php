<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('reference_id')->unsigned();
            $table->string('reference_type');

            $table->integer('last_message_id')->unsigned()->nullable()->default(null);
            $table->string('last_message_preview')->nullable()->default(null);
            $table->integer('message_count')->unsigned()->default(1);

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
        Schema::drop('threads');
    }
}
