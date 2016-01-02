<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function(Blueprint $table) {
            $table->dropColumn('reference_id');
            $table->dropColumn('reference_type');

            $table->integer('brief_id')->undigned()->default(null)->after('id');
            $table->integer('project_id')->unsigned()->after('id');
            $table->integer('created_by')->unsigned()->after('id');

            $table->integer('amount')->nullable()->default(null)->after('stripe_invoice_id');

            $table->tinyInteger('upfront_percent')->nullable()->default(null)->after('stripe_invoice_id');
            $table->string('stripe_upfront_invoice_id')->nullable()->default(null)->after('stripe_invoice_id');

            $table->json('line_items')->after('status')->nullable()->default(null);
            $table->tinyInteger('speed')->after('status')->nullable()->default(null);
            $table->json('speeds')->after('status');
            $table->json('users_to_notify')->after('status');
            $table->date('date')->after('status');

            $table->renameColumn('discount', 'discount_percent');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function(Blueprint $table) {
            $table->integer('reference_id');
            $table->string('reference_type');

            $table->dropColumn([
                'created_by',
                'project_id',
                'brief_id',
                'upfront_percent',
                'stripe_upfront_invoice_id',
                'amount',
                'speeds',
                'speed',
                'users_to_notify',
                'date',
                'line_items'
            ]);

            $table->renameColumn('discount_percent', 'discount');
        });
    }
}