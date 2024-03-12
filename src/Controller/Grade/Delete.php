<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

 /**
 * @OA\Delete(
 *     tags={"Grades"},
 *     path="/{id}",
 *     @OA\Response(response="200", description="Delete a grade by id")
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