<?php

namespace App\Providers;

use App\Auth\Jwt\Auth;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Auth::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Auth::class, function() {
            return new Auth();
        });
    }
}
