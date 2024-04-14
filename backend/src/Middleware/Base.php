<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
            $exp = $decoded->exp ?? null; //Expiration time, se face check daca tokenul a expirat direct in decode dar daca vrem sa facem ceva cu el mai tarziu e bine sa il luam
            $user_id = $decoded->user_id ?? null; //User id luat de la google deci unic da inca nu stiu ce facem cu el
            return $decoded;
        } catch (\UnexpectedValueException $e) {
            throw new Auth('Forbidden: you are not authorized. ' . $e->getMessage(), 403);
        }
    }
}
