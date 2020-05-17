<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Order;
use App\Token;
use App\Tracking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function history(Request $request) {
        $token = $request->header('token') ?? $request->input('token');
        $user =  User::where('token', $token)->first();
        $history = DB::table('orders AS O')
                    ->select("O.price","O.payment_status","O.status","S.name","M.merchant_name","O.created_at")
                    ->join('services AS S', 'O.service_id', '=', 'S.id')
                    ->join('merchants AS M', 'M.merchant_id', '=', 'S.merchant_id')
                    ->where("O.customer_id",$user->id)
                    ->orderBy("O.id","desc")
                    ->get();

        $history = array_map(function($item) {
            return [
                "price"          => $item->price >0 ? "Rp ".number_format($item->price, 0, '', '.') : "On Calculating",
                "payment_status" => $item->payment_status,
                "status"         => $item->status,
                "statusMessage"  => Tracking::statusMessage($item->status),
                "name"           => $item->name,
                "merchant_name"  => $item->merchant_name,
                "created_at"     => \Carbon\Carbon::parse($item->created_at)->format("d M Y, h:i:s")
            ];
        },$history->toArray());

        if ($history) {
            $out = [
                "message" => "Success Show History list",
                "statusCode"    => 201,
                "history" => $history,
            ];
        } else {
            $out = [
                "message" => "Failed to Show History list",
                "statusCode"   => 404,
                "history" => null,
            ];
        }

        return response()->json($out, $out['statusCode']);
    }

    public function orderDetail(Request $request) {
        $order_id = $request->input('order_id');
        $orderDetail = DB::table('orders AS O')
                    ->select("O.price","O.status","O.notes","O.payment_via","O.payment_status","O.payment_bank_id","O.payment_date","S.name","M.merchant_name","O.created_at")
                    ->join('services AS S', 'O.service_id', '=', 'S.id')
                    ->join('merchants AS M', 'M.merchant_id', '=', 'S.merchant_id')
                    ->where("O.id",$order_id)
                    ->first();

        $history = Tracking::where("order_id",$order_id)->get();
        $history = array_map(function($item) {
            return [
                "status"        => $item["status"],
                "statusMessage" => Tracking::statusMessage($item["status"]),
                "description"   => $item["description"],
                "created_at"    => \Carbon\Carbon::parse($item["created_at"])->format("d M Y, h:i:s")
            ];
        },$history->toArray());

        if ($orderDetail) {
            $out = [
                "message" => "Success to Show Detail Order",
                "statusCode"    => 201,
                "detail" => $orderDetail,
                "history" => $history,
            ];
        } else {
            $out = [
                "message" => "Failed to Show Detail Order",
                "statusCode"   => 404,
                "detail" => null,
                "history" => null,
            ];
        }
        return response()->json($out, $out['statusCode']);
    }
}
