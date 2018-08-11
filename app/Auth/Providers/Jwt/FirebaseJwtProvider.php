<?php

namespace App\Auth\Providers\Jwt;

use Firebase\JWT\JWT;

class FirebaseJwtProvider implements JwtProviderInterface
{
    protected $settings;

    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function encode(array $claims)
    {
        return JWT::encode($claims, $this->settings['secret'], $this->settings['algo']);
    }
}
