<?php

use App\Auth\Jwt\Auth;
use App\Middleware\Authenticate;
use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;

$app->get('/', HomeController::class . ':index')
    ->add(new Authenticate($container->get(Auth::class)));

$app->post('/auth/login', LoginController::class . ':login');
