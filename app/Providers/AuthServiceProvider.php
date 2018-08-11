<?php

namespace App\Providers;

use App\Auth\Jwt\Auth;
use App\Auth\Jwt\Factory;
use App\Auth\Jwt\ClaimsFactory;
use App\Auth\Providers\Auth\EloquentAuthProvider;
use League\Container\ServiceProvider\AbstractServiceProvider;

class AuthServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        Auth::class
    ];

    public function register()
    {
        $container = $this->getContainer();

        $container->share(Auth::class, function() use ($container) {

            $claimsFactory = new ClaimsFactory(
                $container->get('request'),
                $jwtSettings = $container->get('settings')->get('jwt')
            );

            return new Auth(
                new EloquentAuthProvider(),
                new Factory($claimsFactory, $jwtSettings)
            );

        });
    }
}
