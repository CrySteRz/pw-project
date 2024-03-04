<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\Auth;
use Firebase\JWT\JWT;

abstract class Base
{
    private $publicKey;
    private $keyId; // Add a property for the Key ID

    public function __construct()
    {
        // Load RSA public key and Key ID
        $this->publicKey = file_get_contents(__DIR__ . './../../util/public_key.pem');
        $this->keyId = 'Dev_RSA_Pair';
    }

    protected function checkToken(string $token): object
    {
        try {
            $decoded = JWT::decode($token, $this->publicKey, ['RS256']);
            
            // Accessing the header directly from the decoded token
            $header = $decoded->header;
            
            // Check the algorithm
            $algorithm = $header->alg ?? null;

            if ($algorithm !== 'RS256') {
                throw new Auth('Invalid algorithm', 403);
            }

            return $decoded;
        } catch (\UnexpectedValueException $e) {
            throw new Auth('Forbidden: you are not authorized. ' . $e->getMessage(), 403);
        }
    }
}
