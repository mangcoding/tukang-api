<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Order;
use App\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use App\Geoapi;

class MerchantController extends Controller
{
    public function show() {
        $merchant = DB::table('services AS S')
        ->join('merchants AS M', 'M.merchant_id', '=', 'S.merchant_id')
        ->join('address AS A', 'A.user_id', '=', 'S.merchant_id')
        ->select("S.id", "S.name", "S.price", "M.merchant_name", "A.address", "A.lattitudes", "A.longitudes")
        ->where("A.is_primary","1")->get();

        if ($merchant) {
            $out = [
                "message" => "show_merchants_sucess",
                "statusCode"    => 201,
                "merchants" => $merchant,
            ];
        } else {
            $out = [
                "message" => "show_merchants_failed",
                "statusCode"   => 404,
                "merchants" => null,
            ];
        }

        return response()->json($out, $out['statusCode']);
    }

    public function order() {
        $this->validate($request, [
            'service_id'  => 'required',
            'customer_id' => 'required',
            'price'       => 'required',
        ]);
 
        $email = $request->input("email");
        $role_id = 3;
        $password = $request->input("password");
        $hashPwd = Hash::make($password);
        $token = $this->generateRandomString();
        $orderData = [
            "service_id"  => $email,
            "customer_id" => $email,
            "price"       => $hashPwd,
        ];

        $order = Order::create($orderData);
        if ($order) {
            $trackingData = [
                "order_id"    => $order->id,
                "status"      =>0,
                "description" =>"Pesanan dibuat. menunggu konfirmasi tukang servis"
            ];
        }
        $out = [
            "message" => "Order created",
            "statusCode"    => 201,
        ];
        return response()->json($out, $out['statusCode']);
    }
}
