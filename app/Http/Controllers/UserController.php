<?php

namespace App\Http\Controllers;
 
use App\User;
use App\LogUser;
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
            'first_name' => 'required',
            'phone' => 'required|unique:customers',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->input("email");
        $role_id = 3;
        $password = $request->input("password");
        $hashPwd = Hash::make($password);
        $token = $this->generateRandomString();
        $data = [
            "username" => $email,
            "email"    => $email,
            "password" => $hashPwd,
            "role_id"  => $role_id,
            "token"    => $token,
        ];
 
 
        if ($user = User::create($data)) {
            $profile = [
                "first_name" => $request->input("first_name"),
                "last_name" => $request->input("last_name"),
                "phone" => $request->input("phone"),
                "customer_id" => $user->id,
            ];
            DB::table('customers')->insert($profile);
            $profile["email"] = $user->email;
            $out = [
                "message" => "register_success",
                "statusCode"    => 201,
                "result"  => [
                    "user" => [
                        "token" => $token,
                        "role" => $user->role_id,
                        "user_id" => $user->id,
                    ],
                    "profile" => $profile,
                ],
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
                    "profile" => $profile,
                ],
            ];

            //Log User
            $dataLog = [
                "user_id"    => $user->id,
                "ip_address" => $request->ip(),
                // "macid"      => null,
                "login_at"   => date("Y-m-d H:i:s")
            ];

            LogUser::create($dataLog);

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
