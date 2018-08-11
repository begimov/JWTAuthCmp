<?php

namespace App\Auth\Jwt;

use App\Auth\Providers\Jwt\JwtProviderInterface;

class Factory
{
    protected $claims = [];

    protected $claimsFactory;

    protected $jwtProvider;

    public function __construct(ClaimsFactory $claimsFactory, JwtProviderInterface $jwtProvider)
    {
        $this->claimsFactory = $claimsFactory;
        
        $this->jwtProvider = $jwtProvider;
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
        return $this->jwtProvider->encode($claims);
    }
}
