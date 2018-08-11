<?php

namespace App\Auth\Jwt;

use Carbon\Carbon;
use Slim\Settings;
use Slim\Http\Request;

class ClaimsFactory
{
    protected $defaultClaims = [
        'iss', 'iat', 'nbf', 'jti', 'exp'
    ];

    protected $request;

    protected $settings;

    public function __construct(Request $request, Settings $settings)
    {
        $this->request = $request;

        $this->settings = $settings;
    }

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
