<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id');
            $table->foreignId('customer_id');
            $table->decimal("price",10,2)->nullable();
            $table->enum("payment_status",[0,1])->default(1);
            $table->enum("payment_via",[1,2])->default(1)->comment("1=Cash, 2=Transfer Manual, 3=Transfer Otomatis");
            $table->foreignId("payment_bank_id")->nullable();
            $table->dateTime("payment_date")->nullable();
            $table->enum("status",[0,1,2,3,4,5,6,7])->comment("0 = New Order, 1=Order Accepted, 2=Barang di Pickup, 3=Sedang di Process, 4=Barang diantar ke customer, 5=Order selesai, 6=Order Cancel, 7=Order Refund");
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->foreign('payment_bank_id')->references('id')->on('banks');
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
        Schema::dropIfExists('orders');
    }
}
