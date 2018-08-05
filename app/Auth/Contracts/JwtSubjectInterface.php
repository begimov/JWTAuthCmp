<?php

namespace App\Auth\Contracts;

interface JwtSubjectInterface
{
    public function getJwtId();
}