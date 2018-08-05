<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};
use App\Auth\Jwt\Auth;

class LoginController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request, Response $response, $args)
    {
        if (!$token = $this->auth->attempt('begimov@gmail.com', 'password')) {
            return $response->withJson([
                'error' => 'Failed to authenticate'
            ], 401);
        }

        return $response->withJson([
            'data' => [
                'token' => $token
            ]
        ]);
    }
}
