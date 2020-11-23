<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name')->nullable();
            $table->string('category_name_bn')->nullable();
            $table->tinyInteger('serial_num');
            $table->text('order_label')->nullable()->comment('Like Order, Request, Apply');
            $table->text('short_description')->nullable();
            $table->string('icon_photo')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('link');
            $table->tinyInteger('type')->default(1)->comment('1=Business, 2=Product');
            $table->tinyInteger('post_type')->default(1)->comment('1=Normal, 2=Special');
            $table->tinyInteger('ad_view_type')->default(1)->comment('1=Grid View, 2=List View');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
