<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make($data['password']),
            'cpf' => $data['cpf'],
            'role' => 'client'
        ]);
    }

    public function users()
    {
        return response()->json((User::with(['meta'])->where('role', '!=', 'client')->get())->toArray(), 200);
    }

    public function hasplayer_id($id)
    {
        return count(\DB::table('users')->where('id', '=', $id)->select('player_id')->get());
    }

    public function set_playerid(Request $request)
    {
        $data = $request->all();
        \Log::info($data);
        return User::where('id', Auth::user()->id)->update(['player_id' => $data['player_id']]);
    }

}
