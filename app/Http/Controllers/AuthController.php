<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function auth(Request $request)
    {

        try {

            $credentials = $request->only('email', 'password');

            Auth::attempt($credentials);
            $success['token'] = Auth::user()->createToken('bseg')->accessToken;
            return response()->json(['success' => $success], 200);

        } catch (\Exception $exception) {
            return response()->json(['error' => 'not acessde', 'cause' => $exception], 401);
        }

        return response()->json(['error' => 'Unauthrized'], 401);

    }

    public function details($cpf)
    {
        return User::with(['client', 'notification', 'alerts'])->where('cpf', '=', $cpf)->get();
    }

    public function signup(Request $request)
    {
        $data = $request->all();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'cpf' => $data['cpf'],
            'role' => 'client'
        ]);
    }

}
