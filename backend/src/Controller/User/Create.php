<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Post(
 *     tags={"Users"},
 *     path="/users/",
 *     summary="Create a new user",
 *     description="Creates a new user with the provided data.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="User data to create",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/User")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $user = $request->getParsedBody();
        $createdUser = $this->getUserService()->Create($user);

        return $this->jsonResponse($response, 'success', $createdUser, 200);
    }
}