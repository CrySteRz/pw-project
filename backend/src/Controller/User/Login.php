<?php

declare(strict_types=1);

namespace App\Controller\User;
use Slim\Http\Request;
use Slim\Http\Response;
use Google\Client as Google_Client;
use Firebase\JWT\JWT;
use GuzzleHttp\Client as GuzzleClient;

/**
 * @OA\Post(
 *     tags={"Auth"},
 *     path="/login",
 *     summary="Login a user",
 *     description="Logs in a user with the provided Google Auth code.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Google Auth code",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="code",
 *                     type="string",
 *                     description="Google Auth code"
 *                 ),
 *                 example={"code": "4/aBcD1234efGhIjKlMnOpQRsTuVwXyZ"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User logged in successfully",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="user_complete_name",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="user_email",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="exp",
 *                 type="integer",
 *                 format="int64"
 *             ),
 *             @OA\Property(
 *                 property="role",
 *                 type="integer",
 *                 format="int32"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
final class Login extends Base
{
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
            'user_complete_name' => $userinfo['name'],
            'user_email' => $userinfo['email'],
            'exp' => time() + 3600,
            'role' => $updatedUser->roleId,
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
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }

    return $response->withHeader('Content-Type', 'application/json');
}
}
