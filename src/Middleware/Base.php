<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;

abstract class Base
{
    protected function checkToken(string $token): array
    {
        try {
            return (JWT::decode($token, $_SERVER['JWT_SECRET_KEY'], 'HS256'));
        } catch (\UnexpectedValueException $e) {
            throw new Auth('Forbidden: you are not authorized.' . $e, 403);
        }
    }
} 