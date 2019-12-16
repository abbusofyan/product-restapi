<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request) {
      $this->validate($request, [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed'
      ]);

      try {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $plainPassword = $request->password;
        $user->password = app('hash')->make($plainPassword);

        $user->save();

        return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

      } catch (\Exception $e) {
        return response()->json(['message' => 'User registration failed'], 409);
      }

    }

    public function login(Request $request) {
      $this->validate($request, [
        'email' => 'required|string',
        'password' => 'required|string',
      ]);

      $credentials = $request->only(['email', 'password']);

      if (!$token = Auth::attempt($credentials)) {
        return response()->json(['message' => 'Unauthorized'], 401);
      }

      $user = User::find(Auth::user()->id);
      $user->token = $token;
      $user->save();

      return response()->json([
        'token' => $token,
        'token_type' => 'bearer',
        'expires_in' => Auth::factory()->getTTL() * 60,
      ], 200);

    }
}
