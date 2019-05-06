 <?php

use App\Models\SellProduct;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('invoice_no')->nullable();
            $table->string('memo_no')->nullable();
            $table->integer('dealer_id')->unsigned();
            $table->date('date');

            $table->decimal('grand_total')->unsigned();
            $table->decimal('amount_pay')->unsigned();
            $table->decimal('amount_due')->unsigned();
            $table->boolean('payment_type');
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->boolean('is_verified')->default(SellProduct::UNVERIFIED);

            $table->timestamps();

            

            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_products');
    }
}
