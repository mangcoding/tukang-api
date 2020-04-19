<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RegionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonProvinces = File::get(database_path('json/provinces.json'));
        $dataProvinces = json_decode($jsonProvinces);
        $dataProvinces = collect($dataProvinces);

        foreach ($dataProvinces as $d) {
            $d = collect($d)->toArray();
            $data = [
                "id"        => $d["id"],
                "name"      => $d["name"],
                "latitudes" => $d["latitude"],
                "longitudes" => $d["longitude"],
            ];
            DB::table('provinces')->insert($data);
        }

        $jsonRegencies = File::get(database_path('json/regencies.json'));
        $dataRegencies = json_decode($jsonRegencies);
        $dataRegencies = collect($dataRegencies);

        foreach ($dataRegencies as $d) {
            $d = collect($d)->toArray();
            $data = [
                "id"          => $d["id"],
                "province_id" => $d["province_id"],
                "name"        => $d["name"],
                "latitudes"   => $d["latitude"],
                "longitudes"  => $d["longitude"],
            ];
            DB::table('regencies')->insert($data);
        }

        $jsonDistricts = File::get(database_path('json/districts.json'));
        $dataDistricts = json_decode($jsonDistricts);
        $dataDistricts = collect($dataDistricts);

        foreach ($dataDistricts as $d) {
            $d = collect($d)->toArray();
            $data = [
                "id"         => $d["id"],
                "regency_id" => $d["regency_id"],
                "name"       => $d["name"],
                "latitudes"  => $d["latitude"],
                "longitudes" => $d["longitude"],
            ];
            DB::table('districts')->insert($data);
        }
    }
}
