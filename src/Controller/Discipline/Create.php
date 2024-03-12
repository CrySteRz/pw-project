<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Post(
 *     tags={"Disciplines"},
 *     path="/disciplines/create",
 *     summary="Create a new discipline",
 *     description="Creates a new discipline with the provided data.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Discipline data to create",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(ref="#/components/schemas/Discipline")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Discipline created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Discipline")
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad request"
 *     )
 * )
 */
final class Create extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $discipline = $this->getDisciplineService()->create($input)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}