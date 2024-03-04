<?php

declare(strict_types=1);

namespace App\Controller\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Google\Client as Google_Client;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;


class Login
{
    private $clientId;
    private $clientSecret;
    private $redirectUri;
    private $privateKey;
    private $keyId;

    public function __construct()
    {
        $this->clientId = $_SERVER['GOOGLE_CLIENT_ID'];
        $this->clientSecret = $_SERVER['GOOGLE_CLIENT_SECRET'];
        $this->redirectUri = $_SERVER['GOOGLE_REDIRECT_URI'];
        $this->privateKey = file_get_contents(__DIR__ . './../../../util/private_key.pem');
        $this->keyId = "Dev_RSA_Pair";
    }

    public function login(Request $request, Response $response, array $args): Response
    {   
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        $scopes = ['email', 'profile']; 
        $client->setScopes($scopes);
        $authUrl = $client->createAuthUrl();
        return $response->withHeader('Location', $authUrl)->withStatus(302);
    }

    public function callback(Request $request, Response $response, array $args): Response
    {
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        
        $code = $request->getQueryParams()['code'];
        $token = $client->fetchAccessTokenWithAuthCode($code);

        $httpClient = new GuzzleClient();
        $responseGoogle = $httpClient->get('https://www.googleapis.com/oauth2/v2/userinfo', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token['access_token']
            ]
        ]);

        $userinfo = json_decode($responseGoogle->getBody()->getContents(), true);
        
    $payload = [
        'user_id' => $userinfo['id'], 
        'exp' => time() + 3600 //1 ora for now  
    ];
    $header = [
        'kid' => $this->keyId,
        'alg' => 'RS256'
    ];
        //$encryptedPayload = openssl_encrypt(json_encode($payload), 'aes-256-cbc', $this->encryptionKey, 0, $this->encryptionKey); VREM SA FACEM ENCRYPT LA PAYLOAD? DECODAM DATELE NUMAI PE BACKEND?
        $jwt = JWT::encode($payload, $this->privateKey, 'RS256', null, $header);
        return $response->withJson(['token' => $jwt]);
    }
}
