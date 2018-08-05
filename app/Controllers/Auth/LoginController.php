<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class LoginController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        return $response->withJson([
            'data' => 'login'
        ]);
    }
}
