<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BulkStock;

class CreateBulkStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->string('lc_number')->nullable();
            $table->date('date');
            $table->integer('grand_total')->unsigned();
            $table->integer('amount_pay')->unsigned();
            $table->integer('amount_due')->unsigned();
            $table->boolean('payment_type');
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->boolean('is_verified')->default(BulkStock::UNVERIFIED);
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bulk_stocks');
    }
}
