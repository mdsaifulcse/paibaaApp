<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceNegotiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_negotiations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ad_post_id');
            $table->foreign('ad_post_id')->references('id')->on('ad_post');

            $table->unsignedBigInteger('request_by');
            $table->foreign('request_by')->references('id')->on('users');

            $table->unsignedBigInteger('request_to');
            $table->foreign('request_to')->references('id')->on('users');

            $table->double('price',10,2)->default(0);
            $table->text('request_message')->nullable();
            $table->string('price_message',255)->nullable();
            $table->tinyInteger('offer',false,1)->comment('1=Offer, 2=Replay');
            $table->tinyInteger('status',false,1)->comment('0=Unread, 2=Read');
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
        Schema::dropIfExists('price_negotiations');
    }
}
