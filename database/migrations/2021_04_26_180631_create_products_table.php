<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable()->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->integer('view')->default(1);

            $table->string('product_name')->unique();
            $table->string('slug');

            $table->string('product_code');
            $table->string('product_quantity');
            $table->text('product_details', 2500);
            $table->string('product_color')->nullable();
            $table->string('product_size')->nullable();

            $table->string('social_link')->nullable();
           
            $table->string('seling_price');
            $table->string('discount_price')->nullable();
            $table->integer('main_slider')->nullable();
            $table->integer('hot_deal')->nullable();
            $table->integer('best_rated')->nullable();
            $table->integer('trend')->nullable();
            $table->integer('mid_slide')->nullable();
            $table->integer('print')->nullable();
            $table->string('main_img');
            $table->string('img_one')->nullable();
            $table->string('img_two')->nullable();
            $table->string('img_three')->nullable();

            $table->integer('status')->default(0);

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
        Schema::dropIfExists('products');
    }
}
