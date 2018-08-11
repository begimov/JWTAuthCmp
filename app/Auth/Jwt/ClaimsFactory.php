<?php

namespace App\Auth\Jwt;

use Carbon\Carbon;

class ClaimsFactory
{
    protected $defaultClaims = [
        'iss', 'iat', 'nbf', 'jti', 'exp'
    ];

    public function getDefaultClaims()
    {
        return $this->defaultClaims;
    }

    public function get($claim)
    {
        if (!method_exists($this, $claim)) {
            return null;
        }

        return $this->{$claim}();
    }

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
