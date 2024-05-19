<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @OA\Get(
 *     tags={"Disciplines"},
 *     path="/discipline/get-types",
 *     summary="Get all discipline types",
 *     description="Retrieves a list of all discipline types.",
 *     @OA\Response(
 *         response=200,
 *         description="List of all discipline types",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/DisciplineType")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */

final class GetDisciplineTypes extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {

        $disciplines = $this->getDisciplineService()->GetDisciplineTypes();

        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}