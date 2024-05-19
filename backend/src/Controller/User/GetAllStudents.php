<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     tags={"Students"},
 *     path="/students/",
 *     summary="Get all students",
 *     description="Retrieves a list of all users with the student role.",
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
 *         description="No students found"
 *     )
 * )
 */
final class GetAllStudents extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $students = $this->getUserService()->getAllStudents();

        return $this->jsonResponse($response, 'success', $students, 200);
    }
}