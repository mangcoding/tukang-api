<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('user_id');
            $table->string("address");
            $table->foreignId("district_id")->comment("Kecamatan");
            $table->foreignId("regency_id")->comment("Kab/Kota");
            $table->foreignId("province_id")->comment("Provinsi");
            $table->string("zipcode")->nullable();
            $table->enum("is_primary",[0,1])->default(1);
            $table->decimal("lattitudes",11,8)->nullable();
            $table->decimal("longitudes",11,8)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
