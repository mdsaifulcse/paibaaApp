<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdPostPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_post_prices', function (Blueprint $table) {
            $table->bigIncrements('id');;


            $table->unsignedBigInteger('ad_post_id');
            $table->foreign('ad_post_id')->references('id')->on('ad_post');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_category');

            $table->string('price_title',200);
            $table->float('price',10,2);

            $table->tinyInteger('is_negotiable',false,1)->default(2)->comment('1=Yes, 2=Fixed');

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
        Schema::dropIfExists('ad_post_prices');
    }
}
