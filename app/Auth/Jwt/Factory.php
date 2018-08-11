<?php

namespace App\Auth\Jwt;

use Firebase\JWT\JWT;

class Factory
{
    protected $claims = [];

    protected $claimsFactory;

    protected $settings;

    public function __construct(ClaimsFactory $claimsFactory, array $settings)
    {
        $this->claimsFactory = $claimsFactory;
        $this->settings = $settings;
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
        return JWT::encode($claims, $this->settings['secret'], $this->settings['algo']);
    }
}
