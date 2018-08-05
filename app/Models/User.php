<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Auth\Contracts\JwtSubjectInterface;

class User extends Model implements JwtSubjectInterface
{
    public function getJwtId()
    {
        return $this->id;
    }
}
