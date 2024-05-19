<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Students"},
 *     path="/students/data",
 *     summary="Get student by email",
 *     description="Retrieves a user by their ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
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

final class GetUserByEmail extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $email = $request->getQueryParams()['email'];
        $discipline = $this->getUserService()->GetUserByEmail($email)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}