<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_product_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sell_product_id')->unsigned();
            $table->integer('stock_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('packet_size_id')->unsigned();
            $table->integer('packet_quantity')->unsigned();
            $table->decimal('sub_quantity', 12, 2)->comment('KG');
            $table->string('unit_price');
            $table->string('total')->comment('tk');
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
        Schema::dropIfExists('sell_product_items');
    }
}
