<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            
            $table->increments('id');


            $table->integer('reference_id')->unsigned();

            $table->string('reference_type');

            $table->integer('user_id')->unsigned();
            $table->integer('parent_message_id')->unsigned()->nullable()->default(null);

            $table->text('comment');

            $table->integer('todo_reference_id')->unsigned()->nullable()->default(null);

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
        Schema::drop('messages');
    }
}
