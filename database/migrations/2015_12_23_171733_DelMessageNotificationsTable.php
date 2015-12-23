<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DelMessageNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('message_notifications');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('message_notifications', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unique()->unsigned();
            $table->integer('message_id')->unsigned();

            $table->timestamps();
        });
    }
}
