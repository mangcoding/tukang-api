<?php

namespace App\Http\Controllers;
 
use App\User;
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
        ->select("S.name", "M.merchant_name", "A.address", "A.lattitudes", "A.longitudes")
        ->where("A.is_primary","1")->get();

        if ($merchant) {
            $out = [
                "message" => "show_merchants_sucess",
                "code"    => 201,
                "merchants" => $merchant,
            ];
        } else {
            $out = [
                "message" => "show_merchants_failed",
                "code"   => 404,
                "merchants" => null,
            ];
        }

        return response()->json($out, $out['code']);
    }
}
