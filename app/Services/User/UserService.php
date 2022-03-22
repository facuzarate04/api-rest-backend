<?php
namespace App\Services\User;

use App\Models\User;
use App\Services\Auth\AuthService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data)
    {
        $user = $this->user->create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'user_type_id' => 2
        ]);
        $this->user = $user->fresh();
        AuthService::login($this->user, $data);
    }



}