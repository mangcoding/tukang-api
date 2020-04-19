<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('merchant_id')->unique();
            $table->string("merchant_name")->nullable();
            $table->string("phone")->nullable();
            $table->string("cp_first_name")->nullable();
            $table->string("cp_last_name")->nullable();
            $table->string("cp_phone")->nullable();
            $table->string("cp_nik")->nullable()->comment("Nomer KTP");
            $table->timestamps();
            $table->foreign('merchant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
