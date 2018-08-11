<?php

namespace App\Auth\Jwt;

class Factory
{
    protected $claims = [];

    protected $claimsFactory;

    public function __construct(ClaimsFactory $claimsFactory)
    {
        $this->claimsFactory = $claimsFactory;
    }

    public function withClaims(array $claims)
    {
        $this->claims = $claims;
        
        return $this;
    }

    public function make()
    {
        $defaultClaims = array_reduce($this->claimsFactory->getDefaultClaims(), function($claims, $claim) {

            $claims[$claim] = $this->claimsFactory->get($claim);

            return $claims;

        }, []);

        return array_merge($this->claims, $defaultClaims);
    }

    public function encode(array $claims)
    {
        return $claims;
    }
}
