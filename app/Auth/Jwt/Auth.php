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

    protected function fromSubject(JwtSubjectInterface $subject)
    {
        return $this->preparePayload($subject);
    }

    protected function preparePayload(JwtSubjectInterface $subject)
    {
        return $this->getSubjectClaims($subject);
    }

    protected function getSubjectClaims(JwtSubjectInterface $subject)
    {
        return [
            'sub' => $subject->getJwtId()
        ];
    }
}
