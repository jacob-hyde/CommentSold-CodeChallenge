<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('inventory_id');
            $table->text('street_address');
            $table->text('apartment')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->string('country_code')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->index();
            $table->string('name')->index();
            $table->string('order_status'); //enum
            $table->text('payment_ref')->nullable();
            $table->string('transaction_id')->nullable()->index();
            $table->integer('payment_amt_cents');
            $table->integer('ship_charged_cents')->nullable();
            $table->integer('ship_cost_cents')->nullable();
            $table->integer('subtotal_cents');
            $table->integer('total_cents');
            $table->text('shipper_name');
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('shipped_date')->nullable();
            $table->text('tracking_number')->nullable();
            $table->integer('tax_total_cents');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('inventory_id')->references('id')->on('inventory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
