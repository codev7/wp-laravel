<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->json('line_items')->nullable()->default(null);
            $table->decimal('invoice_total',10,2)->default(0);
            $table->integer('discount')->nullable()->default(null);
            $table->string('status');
            $table->date('date_paid')->nullable()->default(null);
            $table->integer('project_id');
                       
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
        Schema::drop('invoices');
    }
}
