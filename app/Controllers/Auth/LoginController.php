<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class LoginController extends Controller
{
    // protected $auth;

    // public function __construct(Auth $auth)
    // {
    //     $this->auth = $auth;
    // }

    public function index(Request $request, Response $response, $args)
    {
        // if (!$token = $this->auth->attempt($request->email, $request->password))) {
        //     return $response->withStatus(401);
        // }

        return $response->withJson([
            'data' => [
                'token' => 'token'
            ]
        ]);
    }
}
