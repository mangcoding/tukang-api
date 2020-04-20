<?php

namespace App\Http\Controllers;
 
use App\User;
use App\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
                "result"  => [
                    "token" => null,
                ]
            ];
            return response()->json($out, $out['statusCode']);
        }
 
        if (Hash::check($password, $user->password)) {
            $newtoken  = $this->generateRandomString();
            
            $user->token = $newtoken;
            $user->save();
            
            $out = [
                "message" => "login_success",
                "statusCode"    => 200,
                "result"  => [
                    "userid" => $user->id,
                    "token" => $newtoken,
                    "role" => $user->role_id,
                ],
            ];
        } else {
            $out = [
                "message" => "Wrong username and password",
                "statusCode"    => 401,
                "result"  => [
                    "token" => null,
                ]
            ];
        }
 
        return response()->json($out, $out['statusCode']);
    }

    private function generateRandomString() {
        $token = new Token();
        return $token->getToken(64);
    }
}
