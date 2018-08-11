<?php

namespace App\Middleware;

use App\Auth\Jwt\Auth;
use Slim\Http\Request;
use Slim\Http\Response;

class Authenticate
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$header = $this->getAuthorizationHeader($request)) {
            return $response->withStatus(401);
        }

        try {
            $this->auth->authenticate($header);
        } catch(\Exception $e) {
            // respond with 401 message
        }

        return $next($request, $response);
    }

    protected function getAuthorizationHeader($request)
    {
        if (empty($headers = $request->getHeader('Authorization'))) {
            return false;
        }

        list($header) = $headers;

        return $header;
    }
}
