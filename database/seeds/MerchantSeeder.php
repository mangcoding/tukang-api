<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Token;
use App\Geoapi;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            "name" => "Service Elektronik",
            "slug" => "service-elektronik",
            "description" => "Service Elektronik TV, Kulkas, Mesin Cuci",
        );
        DB::table('categories')->insert($categories);

        $categories = array(
            "name" => "Food Catering",
            "slug" => "food-catering",
            "description" => "Pemesanan Catering untuk sekolah dan kantor",
        );
        DB::table('categories')->insert($categories);

        $categories = array(
            "name" => "Others",
            "slug" => "others",
            "description" => "Pertukangan lainnya",
        );
        DB::table('categories')->insert($categories);

        Mitra
        $token = new Token();
        $mitra2 = array(
            "username" => "mitra-ele@calltukang.id",
            "email" => "mitra-ele@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra2);
        if ($User) {
            $dataMitra2 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Changgeum Elektoronik",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Wahyudi",
            );
            DB::table('merchants')->insert($dataMitra2);
        }

        Address Dummy
        $address = "Griya Karang Asri 2 blok A8, Karangtengah Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Service Elektoronik dan Kulkas",
            "description"     => "Service Kulkas",
            "categories_id"   => 2,
            "merchant_id"     => $User->id,
            "is_custom_price" => "0",
            "price"           => "200000",
        );
        DB::table('services')->insert($data);

        $token = new Token();
        $mitra3 = array(
            "username" => "mitra3@calltukang.id",
            "email" => "mitra3@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra3);
        if ($User) {
            $dataMitra3 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Ucha Cellular",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Andreas",
            );
            DB::table('merchants')->insert($dataMitra3);
        }

        //Address Dummy
        $address = "Jalan Almuwahiddin, Karangtengah Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Jasa Pembuatan Custom Case",
            "description"     => "Jasa Pembuatan Casing HP Android dan Iphone",
            "categories_id"   => 1,
            "merchant_id"     => $User->id,
            "is_custom_price" => "0",
            "price"           => "200000",
        );
        DB::table('services')->insert($data);


        $token = new Token();
        $mitra4 = array(
            "username" => "mitra4@calltukang.id",
            "email" => "mitra4@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra4);
        if ($User) {
            $dataMitra4 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Dhewa Food",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Ade Rukmana",
            );
            DB::table('merchants')->insert($dataMitra4);
        }

        //Address Dummy
        $address = "Griya Karangtengah Asri, Desa Ciheulang Tonggoh, Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Jasa Pembuatan Makanan",
            "description"     => "Jasa Pembuatan Casing HP Android dan Iphone",
            "categories_id"   => 3,
            "merchant_id"     => $User->id,
            "is_custom_price" => 1,
        );
        DB::table('services')->insert($data);


        $token = new Token();
        $mitra5 = array(
            "username" => "mitra5@calltukang.id",
            "email" => "mitra5@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra5);
        if ($User) {
            $dataMitra5 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Mignon Clothes",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Migu Migu",
            );
            DB::table('merchants')->insert($dataMitra5);
        }

        //Address Dummy
        $address = "Jl. Raya Sukaraja - Sukabumi, Karangtengah, Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Tukang baju",
            "description"     => "Jasa Pembuatan Pakaian custom",
            "categories_id"   => 4,
            "merchant_id"     => $User->id,
            "is_custom_price" => 1,
        );
        DB::table('services')->insert($data);


        $token = new Token();
        $mitra6 = array(
            "username" => "mitra6@calltukang.id",
            "email" => "mitra6@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra6);
        if ($User) {
            $dataMitra6 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Bigo Cellular",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Firman",
            );
            DB::table('merchants')->insert($dataMitra6);
        }

        //Address Dummy
        $address = "Jalan Cireundeu No.10, Jl. Pabuaran, RT.01/RW.01, Ciheulang Tonggoh, Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Service HP",
            "description"     => "Service HP",
            "categories_id"   => 1,
            "merchant_id"     => $User->id,
            "is_custom_price" => 1,
        );
        DB::table('services')->insert($data);


        $token = new Token();
        $mitra7 = array(
            "username" => "mitra7@calltukang.id",
            "email" => "mitra7@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra7);
        if ($User) {
            $dataMitra7 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Pijat Keliling Abah Anom",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Vino",
            );
            DB::table('merchants')->insert($dataMitra7);
        }

        //Address Dummy
        $address = "Saung kuring, kampung pasar, Karangtengah, Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Terima Jasa Pijat",
            "description"     => "Service HP",
            "categories_id"   => 1,
            "merchant_id"     => $User->id,
            "is_custom_price" => "0",
            "price"           => 100000
        );
        DB::table('services')->insert($data);


        $token = new Token();
        $mitra8 = array(
            "username" => "mitra8@calltukang.id",
            "email" => "mitra8@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra8);
        if ($User) {
            $dataMitra8 = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Tukang Cukur Keliling",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Finto Abramovic",
            );
            DB::table('merchants')->insert($dataMitra8);
        }

        //Address Dummy
        $address = "Taman Kota Karangtengah, Karangtengah, Cibadak Kab. Sukabumi";
        $location = Geoapi::generateLatLon($address);
        $dataAddress = array(
            "user_id"   => $User->id,
            "address" => $address,
            "district_id" => 3202210,
            "regency_id" => 3202,
            "province_id" => 32,
            "zipcode" => 43353,
            "is_primary"=> 1,
            "lattitudes" => $location->lat,
            "longitudes" => $location->lng,
        );
        DB::table('address')->insert($dataAddress);

        //Service Dummy
        $data = array(
            "name"            => "Terima Jasa Cukur panggilan",
            "description"     => "Tidak mau antri saat bercukur, kami siap mendatangi anda",
            "categories_id"   => 1,
            "merchant_id"     => $User->id,
            "is_custom_price" => "0",
            "price"           => 50000
        );
        DB::table('services')->insert($data);
    }
}
