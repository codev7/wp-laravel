<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function(Blueprint $table) {
            
            $table->increments('id');

            /* field to hold the text from the brief that the client submits */
            $table->text('project_brief')->nullable()->default(null);

            /* id of the customer who submitted the lead */
            $table->integer('user_id');

            /* id of the project type, null if the user did not include one */
            $table->integer('project_type_id')->nullable()->default(null);

            /* the deadline for the lead, null if the user did not include one */
            $table->string('lead_deadline')->nullable()->default(null);

            /* json array of any files uploaded with the brief */
            $table->json('files')->nullable()->default(null);

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
        Schema::drop('leads');
    }
}
