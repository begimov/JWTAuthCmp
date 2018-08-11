<?php

namespace App\Auth\Jwt;

use Carbon\Carbon;

class ClaimsFactory
{
    public function iss()
    {
        return 'http://jwtauthcmp.test/auth/login';
    }

    public function iat()
    {
        return Carbon::now()->getTimestamp();
    }

    public function nbf()
    {
        return $this->iat();
    }

    public function jti()
    {
        return bin2hex(str_random(32));
    }

    public function exp()
    {
        return Carbon::now()->addMinutes(10)->getTimestamp();
    }
}
