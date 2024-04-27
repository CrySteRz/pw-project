<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class TeacherAuth extends Base
{
    public function __invoke(
        Request $request,
        Response $response,
        Route $next
    ): ResponseInterface {
        $decoded = $this->verifyToken($request);
        if ($decoded->role !== 2) {
            throw new \App\Exception\Auth('Unauthorized. Teacher role required.', 403);
        }
        return $next($request->withParsedBody($decoded), $response);
    }
}