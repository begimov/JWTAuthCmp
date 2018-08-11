<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class Authenticate
{
    public function __invoke(Request $request, Response $response, $next)
    {
        return $next($request, $response);
    }
}
