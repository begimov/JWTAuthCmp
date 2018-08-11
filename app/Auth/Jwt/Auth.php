<?php

namespace App\Auth\Jwt;

use App\Auth\Jwt\Factory;
use App\Auth\Contracts\JwtSubjectInterface;
use App\Auth\Providers\Auth\AuthProviderInterface;

class Auth
{
    protected $auth;

    protected $factory;

    public function __construct(AuthProviderInterface $auth, Factory $factory)
    {
        $this->auth = $auth;
        $this->factory = $factory;
    }

    public function attempt($email, $password)
    {
        if (!$user = $this->auth->byEmailAndPassword($email, $password)) {
            return null;
        }

        return $this->fromSubject($user);
    }

    public function authenticate($header)
    {
        return;
    }

    protected function fromSubject(JwtSubjectInterface $subject)
    {
        return $this->factory->encode($this->generatePayload($subject));
    }

    protected function generatePayload(JwtSubjectInterface $subject)
    {
        return $this->factory->withClaims($this->getSubjectClaims($subject))->make();
    }

    protected function getSubjectClaims(JwtSubjectInterface $subject)
    {
        return [
            'sub' => $subject->getJwtId()
        ];
    }
}
