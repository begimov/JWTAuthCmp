<?php

namespace App\Auth\Jwt;

use App\Auth\Providers\Auth\AuthProviderInterface;

class Auth
{
    protected $auth;

    public function __construct(AuthProviderInterface $auth)
    {
        $this->auth = $auth;    
    }

    public function attempt($email, $password)
    {
        if (!$user = $this->auth->byEmailAndPassword($email, $password)) {
            return null;
        }

        return 'token';
    }
}
