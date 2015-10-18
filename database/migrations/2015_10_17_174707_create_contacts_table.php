<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable()->default(null);
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->date('last_contacted')->nullable()->default(null);
            $table->integer('company_id')->unsigned();
            $table->integer('pipeline_deals_id')->unsigned()->nullable();
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
        Schema::drop('contacts');
    }
}
