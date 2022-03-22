<?php
namespace App\Services\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService {

    public static function login(User $user, $data)
    {
        if(!Auth::attempt($data))
        {
            return [
                'error' => 'Unauthorized',
                'code' => 401
            ];
        }
        $accessToken = Auth::user()->createToken('access_token')->accessToken;

        return [
            'user' => $user,
            'access_token' => $accessToken->token,
            'token_type' => 'Bearer'
        ];

    } 

}