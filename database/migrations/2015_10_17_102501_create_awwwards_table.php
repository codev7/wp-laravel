<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwwwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awwwards', function (Blueprint $table) {
            $table->increments('id');

            $table->string('username')->unique();
            $table->string('name');
            $table->string('site_url')->nullable();

            $table->string('twitter')->nullable();
            $table->string('gplus')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('skype')->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->integer('karma')->unsigned()->default(30)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('awwwards');
    }
}
