<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('products_labels', function (Blueprint $table) {
      $table->integer('product_id')->unsigned();
      $table->foreign('product_id')->references('id')->on('products');

      $table->integer('label_id')->unsigned();
      $table->foreign('label_id')->references('id')->on('labels');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_labels');
    }
}
