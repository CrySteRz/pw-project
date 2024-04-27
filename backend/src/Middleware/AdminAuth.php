<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class AdminAuth extends Auth
{
    public function __invoke(
        Request $request,
        Response $response,
        Route $next
    ): ResponseInterface {
        $decoded = $this->verifyToken($request);
        if ($decoded->role !== 1) {
            throw new \App\Exception\Auth('Unauthorized. Admin role required.', 403);
        }
        return $next($request->withParsedBody($decoded), $response);
    }
}