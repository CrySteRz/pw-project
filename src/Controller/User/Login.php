<?php

declare(strict_types=1);

namespace App\Controller\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Google\Client as Google_Client;

class Login
{
    public function login(Request $request, Response $response, array $args): Response
    {   
        $clientId = $_SERVER['GOOGLE_CLIENT_ID'];
        $clientSecret = $_SERVER['GOOGLE_CLIENT_SECRET'];
        $redirectUri = 'http://localhost:8080/google/auth/callback';
        $client = new Google_Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $scopes = ['email', 'profile']; 
        $client->setScopes($scopes);
        $authUrl = $client->createAuthUrl();
        return $response->withHeader('Location', $authUrl)->withStatus(302);
    }

    public function callback(Request $request, Response $response, array $args): Response
    {
        $clientId = $_SERVER['GOOGLE_CLIENT_ID'];
        $clientSecret = $_SERVER['GOOGLE_CLIENT_SECRET'];
        $redirectUri = 'http://localhost:8080/google/auth/callback';

        $client = new Google_Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);

        $code = $request->getQueryParams()['code'];
        $token = $client->fetchAccessTokenWithAuthCode($code);
        echo $code;
        // Use $token to make API requests or store it for later use

        return $response->write('Authentication successful!');
    }
}
