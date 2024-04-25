<?php

declare(strict_types=1);

namespace App\Controller\User;
use Slim\Http\Request;
use Slim\Http\Response;
use Google\Client as Google_Client;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;
class Login extends Base
{

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
    
    public function __invoke(Request $request, Response $response): Response{
    
    $body = json_decode($request->getBody()->getContents(), true);
    $code = $body['code'];

    $client = new Google_Client();
    $client->setClientId($_SERVER['GOOGLE_CLIENT_ID']);
    $client->setClientSecret($_SERVER['GOOGLE_CLIENT_SECRET']);
    $client->setRedirectUri($_SERVER['GOOGLE_REDIRECT_URI']);
    $token = $client->fetchAccessTokenWithAuthCode($code);

    $httpClient = new GuzzleClient();
    $responseGoogle = $httpClient->get('https://www.googleapis.com/oauth2/v2/userinfo', [
        'headers' => [
            'Authorization' => 'Bearer ' . $token['access_token']
        ]
    ]);

    $userinfo = json_decode($responseGoogle->getBody()->getContents(), true);
    try {
        $user = $this->getUserService()->getUserByEmail($userinfo['email']);
        if ($user->id === null) {
            return $this->jsonResponse($response, 'error', "User not found", 404);
        }
        if ($user->google_id === null || $user->google_id !== $userinfo['id']) {
            $user->updateGoogleId($userinfo['id']);
            $this->getUserService()->Update($user, $userinfo['email']);
        }

        $updatedUser = $this->getUserService()->getUserByEmail($userinfo['email']);
        $payload = [
            'user_email' => $userinfo['email'],
            'exp' => time() + 3600,
            'user_id'=> $updatedUser->id,
            'user_roleId' => $updatedUser->roleId,
        ];
        $header = [
            'kid' => $_SERVER['KID'] ?? 'DEV',
            'alg' => 'RS256'
        ];
        $jwt = JWT::encode($payload, file_get_contents(__DIR__ . '/../../../util/private_key.pem'), 'RS256', null, $header);
        $responseData = json_encode(['token' => $jwt]);
        $response->getBody()->write($responseData);
    } catch (\Exception $e) {
        $response->getBody()->write('Error: ' . $e->getMessage());
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
    }

    return $response->withHeader('Content-Type', 'application/json');
}
}
