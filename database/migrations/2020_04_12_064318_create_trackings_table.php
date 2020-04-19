<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->enum("status",[0,1,2,3,4])->comment("0 = New Order, 1=Order Accepted, 2=Barang di Pickup, 3=Sedang di Process, 4=Barang diantar ke customer, 5=Order selesai, 6=Order Cancel, 7=Order Refund");
            $table->string("description");
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('trackings');
    }
}
