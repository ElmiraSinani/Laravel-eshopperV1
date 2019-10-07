<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->date('date');
            $table->text('status');
            $table->date('delivery_date');
            $table->decimal('price',8,2);            
            $table->text('first_name');
            $table->text('last_name');
            $table->text('email');
            $table->text('phone');
            $table->text('address');
            $table->text('country');
            $table->text('state');
            $table->text('zip');
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
}
