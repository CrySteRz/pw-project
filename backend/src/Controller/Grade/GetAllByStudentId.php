<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     tags={"Grades"},
 *     path="/grades/student/{stud_id}",
 *     summary="Get all grades of a student",
 *     description="Retrieves all grades associated with the specified student ID.",
 *     @OA\Parameter(
 *         name="stud_id",
 *         in="path",
 *         required=true,
 *         description="ID of the student",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of grades",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Grade")
 *         )
 *     )
 * )
 */
final class GetAllByStudentId extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $studentId= intval($args["stud_id"]);
        $disciplines = $this->getGradeService()->getAllByUserId($studentId);
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}