<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('ad_post_id')->nullable();
            $table->foreign('ad_post_id')->references('id')->on('ad_post');

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');

            $table->unsignedBigInteger('post_user_id')->nullable();
            $table->foreign('post_user_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->string('booking_date_start')->nullable()->useCurrent()->comment('for rend and service');
            $table->string('booking_date_end')->nullable()->useCurrent()->comment('for rend and service');

            $table->time('booking_time_start')->nullable()->useCurrent()->comment('for rend and service');
            $table->time('booking_time_end')->nullable()->useCurrent()->comment('for rend and service');

            $table->text('txt_message')->nullable();
            $table->string('attach_file')->nullable()->comment('for need');
            $table->string('delivery_address')->nullable()->comment('for sale');
            $table->float('total_amount',10,1)->default('0');
            $table->string('service_meet_up')->nullable()->comment('for service');
            $table->tinyInteger('status',false,1)->comment('0=new order,1=view, 2=delivered,3=reject');

            $table->timestamps();
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
