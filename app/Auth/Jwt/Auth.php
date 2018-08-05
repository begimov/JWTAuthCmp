<?php

namespace App\Auth\Jwt;

use App\Models\User;

class Auth
{
    public function attempt($email, $password)
    {
        if (!$user = User::where('email', $email)->first()) {
            return null;
        }

        if (!password_verify($password, $user->password)) {
            return null;
        }

        return $user->email;
    }
}
