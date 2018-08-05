<?php

namespace App\Auth\Jwt;

use App\Models\User;

class Auth
{
    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        return $user->email;
    }
}
