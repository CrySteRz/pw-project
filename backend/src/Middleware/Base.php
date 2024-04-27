<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;

abstract class Base
{
    private $publicKey;
    

    public function __construct()
    {
        $this->publicKey = file_get_contents(__DIR__ . './../../util/public_key.pem');
    }

    protected function checkToken(string $token): object
    {
        try {
            $decoded = JWT::decode($token, new Key($this->publicKey, 'RS256')); 
            if (!isset($decoded->exp) || !isset($decoded->user_email)) {
                throw new Auth('Forbidden: you are not authorized.', 403);
            }
            if ($decoded->exp < time()) {
                throw new Auth('Forbidden: you are not authorized.', 403);
            }
            return $decoded;
            
        } catch (\UnexpectedValueException $e) {
            throw new Auth('Forbidden: you are not authorized. ' . $e->getMessage(), 403);
        }
    }

    protected function verifyToken(Request $request): object
    {
        $jwtHeader = $request->getHeaderLine('Authorization');
        if (! $jwtHeader) {
            throw new \App\Exception\Auth('JWT Token required.', 400);
        }
        $jwt = explode('Bearer ', $jwtHeader);
        if (! isset($jwt[1])) {
            throw new \App\Exception\Auth('JWT Token invalid.', 400);
        }
        $decoded = (object) $this->checkToken($jwt[1]);
        return $decoded;
    }

    
}
