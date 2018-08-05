<?php

namespace App\Auth\Providers\Auth;

interface AuthProviderInterface
{
    public function byEmailAndPassword($email, $password);
}