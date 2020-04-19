<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            "name"            => "Jasa Pasang Tempered Glass",
            "description"     => "Jasa Pasang Tempered Glass",
            "categories_id"   => 1,
            "merchant_id"     => 1,
            "is_custom_price" => 1
        );
        DB::table('services')->insert($data);
    }
}
