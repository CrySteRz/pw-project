<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Put(
 *     tags={"Grades"},
 *     path="/grades/{id}",
 *     summary="Update a grade by ID",
 *     description="Updates the grade with the specified ID.",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the grade to update",
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Grade data to update",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Updated grade",
 *         @OA\JsonContent(ref="#/components/schemas/Grade")
 *     )
 * )
 */
final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $id = (int) $args['id'];
        $grade = $this->getGradeService()->update($input, $id)->toJson();
        return $this->jsonResponse($response, 'success', $grade, 200);
    }
}