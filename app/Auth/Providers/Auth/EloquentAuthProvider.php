<?php

namespace App\Auth\Providers\Auth;

use App\Models\User;

class EloquentAuthProvider implements AuthProviderInterface
{
    public function byEmailAndPassword($email, $password)
    {
        if (!$user = User::where('email', $email)->first()) {
            return null;
        }

        if (!password_verify($password, $user->password)) {
            return null;
        }

        return $user;
    }
}
