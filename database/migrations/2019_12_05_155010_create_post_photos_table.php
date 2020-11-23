<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_photos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('ad_post_id');
            $table->foreign('ad_post_id')->references('id')->on('ad_post');

            $table->string('photo_one');
            $table->string('photo_two')->nullable();
            $table->string('photo_three')->nullable();
            $table->string('photo_four')->nullable();
            $table->string('photo_five')->nullable();

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
        Schema::dropIfExists('post_photos');
    }
}
