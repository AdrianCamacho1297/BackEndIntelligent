<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth as JWTAuthJWTAuth;

class LoginApiController extends Controller
{
    //Please add this method
    public function login(Request $request) {
        // get email and password from request
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // try to auth and get the token using api authentication
        if (!$token =  JWTAuth::attempt($credentials)) {
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        return response()->json([
            'token' => $token,
            'type' => 'bearer', // you can ommit this
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
            'user' => $user
        ]);

    }
}
