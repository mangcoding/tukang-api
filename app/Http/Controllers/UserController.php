<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->input("email");
        $role_id = $request->input("role_id");
        $password = $request->input("password");
        $hashPwd = Hash::make($password);
        
        $data = [
            "username" => $email,
            "email"    => $email,
            "password" => $hashPwd,
            "role_id"  => $role_id,
            "token"    => $this->generateRandomString(),
        ];
 
 
 
        if (User::create($data)) {
            $out = [
                "message" => "register_success",
                "statusCode"    => 201,
            ];
        } else {
            $out = [
                "message" => "failed_regiser",
                "statusCode"   => 404,
            ];
        }
 
        return response()->json($out, $out['statusCode']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->input("email");
        $password = $request->input("password");
 
        $user = User::where("email", $email)->first();
 
        if (!$user) {
            $out = [
                "message" => "Wrong username and password",
                "statusCode"    => 401,
            ];
            return response()->json($out, $out['statusCode']);
        }
 
        if (Hash::check($password, $user->password)) {
            $newtoken  = $this->generateRandomString();
            
            $user->token = $newtoken;
            $user->save();
            
            $address = DB::table('address')
                        ->select("address","district_id","regency_id","province_id","zipcode","is_primary","lattitudes","longitudes")
                        ->where("user_id",$user->id)
                        ->get();

            $profile = DB::table('customers')
                        ->select("first_name","last_name","phone","nik")
                        ->where("customer_id",$user->id)
                        ->first();
            if ($profile) {
                $profile->email = $user->email;
            }

            $out = [
                "message" => "login_success",
                "statusCode"    => 200,
                "result"  => [
                    "user" => [
                        "token" => $newtoken,
                        "role" => $user->role_id,
                        "user_id" => $user->id,
                    ],
                    "address" => $address,
                    "profile" => $profile,
                ],
            ];
        } else {
            $out = [
                "message" => "Wrong username and password",
                "statusCode"    => 401,
            ];
        }
 
        return response()->json($out, $out['statusCode']);
    }

    private function generateRandomString() {
        $token = new Token();
        return $token->getToken(64);
    }
}
