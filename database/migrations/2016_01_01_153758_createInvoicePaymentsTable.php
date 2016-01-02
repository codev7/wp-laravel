<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePaymentsTable extends Migration
{
    const CODE_DEPOSIT = 'deposit';
    const CODE_FINAL = 'final';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_payments', function(Blueprint $table) {
            $table->increments('id');

            $table->integer('invoice_id')->unsigned()->index();
            $table->string('code'); // deposit / final
            $table->string('stripe_transaction_id')->nullable()->default(null);
            $table->integer('payer_id')->unsigned();
            $table->integer('amount');
            $table->text('meta')->nullable()->default(null);

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
        Schema::drop('invoice_payments');
    }
}
