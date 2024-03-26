<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Patch(
 *     tags={"Users"},
 *     path="/users/{id}",
 *     summary="Partially update user by ID",
 *     description="Updates a user identified by their ID with the provided user data.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="User data to update",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/User")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/User")
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
        $message = [
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }
}