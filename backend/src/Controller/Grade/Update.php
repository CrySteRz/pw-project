<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Patch(
 *     tags={"Grades"},
 *     path="/grades/",
 *     summary="Update a grade",
 *     description="Updates a grade with the provided data.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Grade data to update",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Grade")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Grade updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Grade not found"
 *     )
 * )
 */

final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $updateGradeDto = $request->getParsedBody();
        $new_grade = $updateGradeDto['new_grade'];
        $grade_id = $updateGradeDto['grade_id'];
        $this->getGradeService()->PatchGrade($new_grade, $grade_id);
        return $this->jsonResponse($response, 'success', $updateGradeDto, 200);
    }
}