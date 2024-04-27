<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class StudentAuth extends Base
{
    public function __invoke(
        Request $request,
        Response $response,
        Route $next
    ): ResponseInterface {
        $decoded = $this->verifyToken($request);
        if ($decoded->role !== 3) {
            throw new \App\Exception\Auth('Unauthorized. Student role required.', 403);
        }
        return $next($request->withParsedBody($decoded), $response);
    }
}