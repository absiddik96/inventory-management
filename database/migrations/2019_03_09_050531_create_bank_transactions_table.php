<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('bank_branches')->onDelete('cascade');
            $table->integer('bank_account_id')->unsigned();
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->integer('supervisor_id')->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('transaction_type');
            $table->date('transaction_date');
            $table->string('amount');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('bank_transactions');
    }
}
