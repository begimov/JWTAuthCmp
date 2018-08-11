<?php

namespace App\Auth\Jwt;

use Carbon\Carbon;

class Factory
{
    protected $claims = [];

    public function withClaims(array $claims)
    {
        $this->claims = $claims;
        
        return $this;
    }

    public function make()
    {
        return array_merge($this->claims, [
            'iss' => 'http://jwtauthcmp.test/auth/login',
            'iat' => $now = Carbon::now()->getTimestamp(),
            'nbf' => $now,
            'jti' => bin2hex(str_random(32)),
            'exp' => Carbon::now()->addMinutes(10)->getTimestamp()
        ]);
    }

    public function encode()
    {
        //
    }
}
