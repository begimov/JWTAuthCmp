<?php

namespace App\Auth\Jwt;

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
        return $this->claims;
    }

    public function encode()
    {
        //
    }
}
