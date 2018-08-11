<?php

use App\Controllers\HomeController;
use App\Controllers\Auth\LoginController;

$app->get('/', HomeController::class . ':index')->add(new \App\Middleware\Authenticate($container->get(App\Auth\Jwt\Auth::class)));

$app->post('/auth/login', LoginController::class . ':login');
