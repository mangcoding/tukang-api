<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Token;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generating Role
        DB::table('roles')->insert(["name"=> "Administrator"]);
        DB::table('roles')->insert(["name"=> "Mitra"]);
        DB::table('roles')->insert(["name"=> "Customer"]);

        //Mitra
        $token = new Token();
        $mitra = array(
            "username" => "mitra@calltukang.id",
            "email" => "mitra@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 2,
            "token" => $token->getToken(64),
        );
        $User = User::create($mitra);
        if ($User) {
            $dataMitra = array(
                "merchant_id"   => $User->id,
                "merchant_name" => "Nukasep Service Store",
                "phone"         => "08575940XXX",
                "cp_first_name" => "Nugraha",
            );
            DB::table('merchants')->insert($dataMitra);
        }

        //Customer
        $customer = array(
            "username" => "customer@calltukang.id",
            "email" => "customer@calltukang.id",
            "password" => Hash::make('Password123'),
            "role_id" => 3,
            "token" => $token->getToken(64),
        );
        $UserCustomer = User::create($customer);

        if ($UserCustomer) {
            $dataCustomer = array(
                "customer_id"   => $UserCustomer->id,
                "first_name" => "Nugraha",
                "phone"         => "08575940XXX",
            );
            DB::table('customers')->insert($dataCustomer);
        }
    }
}
