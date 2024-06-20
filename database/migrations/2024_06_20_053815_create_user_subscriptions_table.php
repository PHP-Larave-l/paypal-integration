<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable(); // Use unsignedBigInteger for compatibility
            $table->unsignedInteger('plan_id')->nullable();
            $table->string('paypal_order_id')->nullable();
            $table->string('paypal_plan_id')->nullable();
            $table->string('paypal_subscr_id', 100)->nullable();
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->float('paid_amount', 10, 2);
            $table->string('currency_code', 10);
            $table->string('subscriber_id')->nullable();
            $table->string('subscriber_name')->nullable();
            $table->string('subscriber_email')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');

            $table->index('paypal_subscr_id'); // Index for quick lookup by PayPal subscription ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_subscriptions');
    }
}
