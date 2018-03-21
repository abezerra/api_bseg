<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try
        {
            if(Auth::attempt($credentials))
            {
                $user = Auth::user();
                $success['token'] = $user->createToken('bseg')->accessToken;
                return response()->json(['success' => $success], 200);
            }
        } catch (\Exception $exception) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'Unauthrized', 'cause' => $exception], 500);
        }

    }

    public function details()
    {
        return response()->json(['success' => Auth::user()], 200);
    }

}
