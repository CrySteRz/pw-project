<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     tags={"Disciplines"},
 *     path="/disciplines/{id}",
 *     summary="Get discipline by ID",
 *     description="Retrieves a discipline by its ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the discipline",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Discipline retrieved successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Discipline")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Discipline not found"
 *     )
 * )
 */
final class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $disciplineId= intval($args["id"]);
        $discipline = $this->getDisciplineService()->getOne($disciplineId)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}