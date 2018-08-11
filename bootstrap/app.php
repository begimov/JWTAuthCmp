<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

$app = new Jenssegers\Lean\App();

$container = $app->getContainer();

$container->get('settings')->set('db', [
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'jwtauthcmp',
    'username'  => 'homestead',
    'password'  => 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$container->get('settings')->set('displayErrorDetails', true);

$container->get('settings')->set('jwt', [
    'expiry' => getenv('JWT_EXPIRY'),
    'secret' => getenv('JWT_SECERT'),
    'algo' => getenv('JWT_ALGO')
]);

$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')->get('db'));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container->addServiceProvider(new App\Providers\AuthServiceProvider());

require_once __DIR__ . '/../routes/web.php';
