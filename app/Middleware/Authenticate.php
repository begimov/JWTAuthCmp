<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class Authenticate
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$header = $this->getAuthorizationHeader($request)) {
            return $response->withStatus(401);
        }

        return $next($request, $response);
    }

    protected function getAuthorizationHeader($request)
    {
        if (!list($header) = $request->getHeader('Authorization', false)) {
            return false;
        }

        return $header;
    }
}
