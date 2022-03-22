<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\AuthService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|unique:users|email',
            'name' => 'required|string',
            'password' => 'required|confirmed|string|min:8'
        ]);
        try {
            $user = new User();
            $userService = new UserService($user);
            $response = $userService->create($data);
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $data['email'])->firstOrFail();
        $response = AuthService::login($user, $request->only('email','password'));
        return response()->json($response, 200);
    }
}
