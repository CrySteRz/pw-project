<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Patch(
 *     tags={"Users"},
 *     path="/users/",
 *     summary="Update a user",
 *     description="Updates a user with the provided data.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="User data to update",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/User")
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         required=true,
 *         description="Email of the user to update",
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
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


final class Update extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $user = $request->getParsedBody();
        $email= $request->getQueryParams()['email'];
        $createdUser = $this->getUserService()->Update($user, $email);
        return $this->jsonResponse($response, 'success', $createdUser, 200);
    }
}