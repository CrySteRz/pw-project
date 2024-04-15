<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     tags={"Users"},
 *     path="/users/teacher",
 *     summary="Get all teachers",
 *     description="Retrieves a list of all users with the teacher role.",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/User")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No teachers found"
 *     )
 * )
 */
final class GetAllTeachers extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $students = $this->getUserService()->getAllTeachers();

        return $this->jsonResponse($response, 'success', $students, 200);
    }
}