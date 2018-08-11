<?php

namespace App\Providers\Jwt;

interface JwtProviderInterface
{
    public function encode(array $claims);
}