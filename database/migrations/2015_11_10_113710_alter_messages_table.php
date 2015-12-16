<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function(Blueprint $table) {
            // temporary workaround for a sqlite quirk
            if (env('DB_CONNECTION') == 'sqlite') {
                $table->integer('thread_id')->nullable()->default(null);
            } else {
                $table->integer('thread_id')->unsigned()->after('id')->index();
            }
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->dropColumn(['parent_message_id', 'reference_id', 'reference_type', 'todo_reference_id']);
        });

        Schema::table('messages', function(Blueprint $table) {
            $table->renameColumn('comment', 'content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function(Blueprint $table) {
            $table->dropColumn('thread_id');
            $table->renameColumn('content', 'comment');

            $table->integer('parent_message_id')->unsigned()->nullable()->default(null);
            $table->integer('todo_reference_id')->unsigned()->nullable()->default(null);
            $table->integer('reference_id')->unsigned();
            $table->string('reference_type');
        });
    }
}