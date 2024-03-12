<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Delete(
 *     tags={"Disciplines"},
 *     path="/disciplines/{id}",
 *     summary="Delete discipline by ID",
 *     description="Deletes a discipline by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the discipline to delete",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Discipline deleted successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Discipline")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Discipline not found"
 *     )
 * )
 */
final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $disciplineId= intval($args["id"]);
        $discipline = $this->getDisciplineService()->delete($disciplineId)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}