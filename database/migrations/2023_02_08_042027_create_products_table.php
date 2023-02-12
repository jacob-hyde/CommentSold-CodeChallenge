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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->index();
            $table->text('description');
            $table->text('style');
            $table->text('brand')->nullable();
            $table->string('url')->nullable();
            $table->string('product_type');
            $table->integer('shipping_price');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('admin_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
