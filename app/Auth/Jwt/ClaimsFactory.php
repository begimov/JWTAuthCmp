<?php

namespace App\Auth\Jwt;

use Carbon\Carbon;
use Psr\Http\Message\RequestInterface;

class ClaimsFactory
{
    protected $defaultClaims = [
        'iss', 'iat', 'nbf', 'jti', 'exp'
    ];

    protected $request;

    protected $settings;

    public function __construct(RequestInterface $request, array $settings)
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
        return (string) $this->request->getUri();
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
        return bin2hex(random_bytes(32));
    }

    public function exp()
    {
        return Carbon::now()->addMinutes($this->settings['expiry'])->getTimestamp();
    }
}
