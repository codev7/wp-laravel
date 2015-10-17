<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwwwardCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awwward_category', function (Blueprint $table) {
            $table->integer('awwward_id')->unsigned();
            $table->integer('awwwcategory_id')->unsigned();
            $table->primary(['awwward_id', 'awwwcategory_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('awwward_category');
    }
}
