<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Post(
 *     tags={"Grades"},
 *     path="/grades/",
 *     summary="Create a new grade",
 *     description="Creates a new grade for a student at an exam.",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Grade object to be created",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Grade created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     )
 * )
 */
final class Create extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $grade = $this->getGradeService()->create($input)->toJson();
        return $this->jsonResponse($response, 'success', $grade, 200);
    }
}