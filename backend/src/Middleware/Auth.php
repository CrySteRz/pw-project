<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class Auth extends Base
{
    public function __invoke(
        Request $request,
        Response $response,
        Route $next
    ): ResponseInterface {
        $decoded = $this->verifyToken($request);
        return $next($request->withParsedBody($decoded), $response);
    }
}