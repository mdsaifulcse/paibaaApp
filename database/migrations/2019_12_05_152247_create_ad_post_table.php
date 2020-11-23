<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_post', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('category_id'); //deliverable
            $table->foreign('category_id')->references('id')->on('categories');

            $table->string('title',80);

            $table->string('lang',30)->nullable()->comment('specify ad language');

            $table->string('address',250)->nullable();
            $table->string('contact',40)->nullable();
            $table->float('price',10,2)->nullable();
            $table->tinyInteger('is_negotiable',false,1)->default(2)->comment('1=Yes, 2=Fixed');
            $table->mediumText('tag')->nullable();
            $table->string('link',100);
            $table->text('description')->nullable();
            $table->tinyInteger('is_approved',false,1)->default(2)->comment('1=Yes, 2=Pending,3=No');

            $table->tinyInteger('deliverable',false,1)->default(2)->comment('1=Yes deliverable, 2=No deliverable');
            $table->float('delivery_fee',8,2)->nullable();

            $table->tinyInteger('condition',false,1)->nullable()->comment('1=New, 2=Used')->nullable();
            $table->tinyInteger('status',false)->default(0);

            $table->unsignedBigInteger('visitor')->nullable();

            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('users');
            $table->timestamp('published_till')->nullable();

            $table->author();

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
        Schema::dropIfExists('ad_post');
    }
}
