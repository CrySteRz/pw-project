<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Grades"},
 *     path="/grades/",
 *     summary="Get all grades",
 *     description="Retrieves a list of all grades, optionally filtered by student and teacher email.",
 *     @OA\Parameter(
 *         name="student_email",
 *         in="query",
 *         description="Email of the student",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="teacher_email",
 *         in="query",
 *         description="Email of the teacher",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of all grades",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Grade")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $student_email= $request->getQueryParams()['student_email'] ?? null;
        $teacher_email= $request->getQueryParams()['teacher_email'] ?? null;
        $disciplines = $this->getGradeService()->getFiltered($student_email, $teacher_email);
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}