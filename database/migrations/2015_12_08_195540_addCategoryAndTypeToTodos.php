<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryAndTypeToTodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_dos', function(Blueprint $table) {
            if (env('DB_CONNECTION') == 'sqlite') {
                $table->string('type')->default(null)->nullable();
                $table->string('category')->default(null)->nullable();
            } else {
                $table->string('type');
                $table->string('category');
            }

            $table->string('status')->default('new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('to_dos', function(Blueprint $table) {
            $table->dropColumn('type', 'category', 'status');
        });
    }
}
