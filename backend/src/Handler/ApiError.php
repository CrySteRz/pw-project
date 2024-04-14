<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Handlers\Error;

final class ApiError extends Error
{
    public function __invoke(
        Request $request,
        Response $response,
        \Exception $exception
    ): Response {
        $data = [
            'message' => $exception->getMessage(),
            'class' => 'Exception',
            'status' => 'error',
            'code' => $this->getStatusCode($exception),
        ];
        $body = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $response->getBody()->write((string) $body);

        return $response
            ->withStatus($this->getStatusCode($exception))
            ->withHeader('Content-type', 'application/problem+json');
    }

    private function getStatusCode(\Exception $exception): int
    {
        $statusCode = 500;
        if (is_int($exception->getCode()) &&
            $exception->getCode() >= 400 &&
            $exception->getCode() <= 500
        ) {
            $statusCode = $exception->getCode();
        }

        return $statusCode;
    }
}