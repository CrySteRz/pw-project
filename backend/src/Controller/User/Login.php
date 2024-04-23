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
    private $scopes;
    private $privateKey;
    private $keyId;

    public function __construct()
    {
        $this->clientId = $_SERVER['GOOGLE_CLIENT_ID'];
        $this->clientSecret = $_SERVER['GOOGLE_CLIENT_SECRET'];
        $this->redirectUri = $_SERVER['GOOGLE_REDIRECT_URI'];
        $this->scopes = ['email', 'profile'];
        $this->privateKey = file_get_contents(__DIR__ . './../../../util/private_key.pem');
        $this->keyId = $_SERVER['KID'] ?? 'DEV';
    }


/**
 * @OA\Get(
 *     path="/login",
 *     summary="Redirects user to Google OAuth login",
 *     description="Redirects the user to the Google OAuth login page for authentication.",
 *     @OA\Response(
 *         response=302,
 *         description="Redirect to Google OAuth login page"
 *     )
 * )
 */
    // public function login(Request $request, Response $response, array $args): Response
    // {   
    //     $client = new Google_Client();
    //     $client->setClientId($this->clientId);
    //     $client->setClientSecret($this->clientSecret);
    //     $client->setRedirectUri($this->redirectUri);
    //     $client->setScopes($this->scopes);
    //     return $response->withHeader('Location', $client->createAuthUrl())->withStatus(302);
    // }

// /**
//  * @OA\Get(
//  *     path="/google/auth/callback",
//  *     summary="Callback for Google OAuth authentication",
//  *     description="Handles the callback from Google OAuth authentication and generates a JWT token for the user.",
//  *     @OA\Response(
//  *         response=200,
//  *         description="JWT token generated successfully"
//  *     )
//  * )
//  */
    public function login(Request $request, Response $response, array $args): Response
    {
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);
        
        $code = $request->getParsedBody()['code'];
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
        $jwt = JWT::encode($payload, $this->privateKey, 'RS256', null, $header);
        $responseData = json_encode(['token' => $jwt]);
        $response->getBody()->write($responseData);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
