<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Users"},
 *     path="/users/{id}",
 *     summary="Get user by ID",
 *     description="Retrieves a user by their ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user to retrieve",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
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
final class GetStudentByEmail extends Base
{
    // example: http://localhost:8081/students/data?email=user1@example.com
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $email= $request->getQueryParams()['email'];
        $discipline = $this->getUserService()->GetStudentByEmail($email)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}