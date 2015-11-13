<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function(Blueprint $table) {
            $table->increments('id');

            $table->string('reference_type')->nullable()->default(null);
            $table->integer('reference_id')->unsigned()->nullable()->default(null);

            $table->string('path');
            $table->string('name');
            $table->string('mime');
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('size')->nullable()->default(null);

            $table->index(['reference_type', 'reference_id']);

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
        Schema::drop('files');
    }
}