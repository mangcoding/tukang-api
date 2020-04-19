<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndonesiaRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table-> bigInteger("id",1,1)->unique();
            $table->string("name");
            $table->decimal("latitudes",11,8)->nullable();
            $table->decimal("longitudes",11,8)->nullable();
        });

        Schema::create('regencies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table-> bigInteger("id",1,1)->unique();
            $table->foreignId('province_id');
            $table->string("name");
            $table->decimal("latitudes",11,8)->nullable();
            $table->decimal("longitudes",11,8)->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table-> bigInteger("id",1,1)->unique();
            $table->foreignId('regency_id');
            $table->string("name");
            $table->decimal("latitudes",11,8)->nullable();
            $table->decimal("longitudes",11,8)->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
        Schema::dropIfExists('regencies');
        Schema::dropIfExists('districts');
    }
}
