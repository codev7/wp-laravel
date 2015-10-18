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
            $table->integer('discount')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->date('date_paid')->nullable()->default(null);
            $table->integer('reference_id')->unsigned();
            $table->string('reference_type');                
            $table->string('stripe_invoice_id')->nullable()->default(null);    
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
