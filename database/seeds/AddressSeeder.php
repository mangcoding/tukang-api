<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Geoapi;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::take(3)->get();
        foreach ($users as $user) {
            $address = "Griya Karang Asri 1 blok H8, Karangtengah Cibadak Kab. Sukabumi";
            $location = Geoapi::generateLatLon($address);
            $dataAddress = array(
                "user_id"   => $user->id,
                "address" => $address,
                "district_id" => 3202210,
                "regency_id" => 3202,
                "province_id" => 32,
                "zipcode" => 43353,
                "is_primary"=> 1,
                "lattitudes" => $location->lat,
                "longitudes" => $location->lng,
            );
            //print_r($dataAddress);
            DB::table('address')->insert($dataAddress);
        }
    }
}
