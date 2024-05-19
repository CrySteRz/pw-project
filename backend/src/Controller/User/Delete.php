<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Delete(
 *     tags={"Users"},
 *     path="/users/",
 *     summary="Delete user by ID",
 *     description="Deletes a user by their ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         required=true,
 *         description="ID of the user to delete",
 *         @OA\Schema(type="integer", format="int64")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/User")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found"
 *     )
 * )
 */
final class Delete extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $email= $request->getQueryParams()['email'];
        $deletedUser = $this->getUserService()->Delete($email);

        return $this->jsonResponse($response, 'success', $deletedUser, 200);
    }
}