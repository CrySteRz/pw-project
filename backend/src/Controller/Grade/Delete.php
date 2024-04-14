<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Delete(
 *     tags={"Grades"},
 *     path="/grades/{id}",
 *     summary="Delete a grade by ID",
 *     description="Deletes a grade by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the grade to delete",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Grade deleted successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     )
 * )
 */
final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $gradeId= intval($args["id"]);
        $grade = $this->getGradeService()->delete($gradeId)->toJson();
        return $this->jsonResponse($response, 'success', $grade, 200);
    }
}