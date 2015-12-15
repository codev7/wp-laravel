<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTodos extends Migration
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
                $table->string('title')->nullable()->default(null);
                $table->text('content')->nullable()->default(null);
            } else {
                $table->string('title');
                $table->text('content');
            }
            $table->integer('comment_count')->default(0);
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
            $table->dropColumn(['title', 'content', 'comment_count']);
        });
    }
}