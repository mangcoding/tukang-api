<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Order;
use App\Token;
use App\Tracking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use App\Geoapi;

class MerchantController extends Controller
{
    public function show(Request $request) {
        $lat = $request->input("lat") ?? "-6.89391200";
        $lon = $request->input("lon") ?? "106.81589630";

        $merchant = DB::table('services AS S')
        ->join('merchants AS M', 'M.merchant_id', '=', 'S.merchant_id')
        ->join('address AS A', 'A.user_id', '=', 'S.merchant_id')
        ->select("S.id", "S.name", "S.price", "M.merchant_name", "A.address", "A.lattitudes", "A.longitudes",
            DB::raw('111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS('.$lat.'))
         * COS(RADIANS(A.lattitudes))
         * COS(RADIANS('.$lon.' - A.longitudes))
         + SIN(RADIANS('.$lat.'))
         * SIN(RADIANS(A.lattitudes))))) AS distance_in_km')
        )->where("A.is_primary","1")->having("distance_in_km","<",1)->get();

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

    public function order(Request $request) {
        $this->validate($request, [
            'service_id'  => 'required',
            'customer_id' => 'required',
            'notes'       => 'required',
            'price'       => 'required',
        ]);
 
        $service_id = $request->input("service_id");
        $customer_id = $request->input("customer_id");
        $notes = $request->input("notes");
        $price = \floatval($request->input("price"));

        $orderData = [
            "service_id"  => $service_id,
            "customer_id" => $customer_id,
            "notes"       => $notes,
            'price'       => $price,
        ];

        $order = Order::create($orderData);
        if ($order) {
            $trackingData = [
                "order_id"    => $order->id,
                "status"      => "0",
                "description" =>"Pesanan dibuat. menunggu konfirmasi tukang servis"
            ];
            Tracking::create($trackingData);
        }
        $out = [
            "message"    => "Order created",
            "status"     => 1,
            "statusCode" => 201,
        ];
        return response()->json($out, $out['statusCode']);
    }
}
