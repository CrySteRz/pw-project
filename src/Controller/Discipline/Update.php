<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Patch(
 *     tags={"Disciplines"},
 *     path="/disciplines/{id}",
 *     summary="Partially update discipline by ID",
 *     description="Updates a discipline by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the discipline",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Discipline object to be updated",
 *         @OA\JsonContent(ref="#/components/schemas/Discipline")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Discipline updated successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Discipline")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Discipline not found"
 *     )
 * )
 */
final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $id = (int) $args['id'];
        $discipline = $this->getDisciplineService()->update($input, $id)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}