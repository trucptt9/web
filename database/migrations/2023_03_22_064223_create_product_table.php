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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('product_idcode')->unique();
            $table->string('product_name');
            $table->string('product_unit');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->text('product_content')->nullable();
            $table->text('product_desc')->nullable();
            $table->string('product_price');
            $table->string('product_image')->nullable();
            $table->boolean('product_status');
            $table->integer('product_SLtrongkho');
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
        Schema::dropIfExists('product');
    }
};