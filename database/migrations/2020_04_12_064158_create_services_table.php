<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->foreignId('categories_id');
            $table->foreignId('merchant_id');
            $table->decimal("price",10,2)->nullable();
            $table->enum("is_custom_price",[0,1])->default(0);
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->foreign('merchant_id')->references('merchant_id')->on('merchants');
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
        Schema::dropIfExists('services');
    }
}
