<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Grades"},
 *     path="/grades/student/{stud_id}/exam/{exam_id}",
 *     summary="Get grade of a student at an exam",
 *     description="Retrieves the grade of the specified student at the specified exam.",
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
 *     @OA\Parameter(
 *         name="exam_id",
 *         in="path",
 *         required=true,
 *         description="ID of the exam",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Grade of the student at the exam",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     )
 * )
 */
final class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $studentId= intval($args["stud_id"]);
        $exam_id= intval($args["exam_id"]);
        $disciplines = $this->getGradeService()->getOne($studentId, $exam_id)->toJson();
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}