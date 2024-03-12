<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Delete(
 *     tags={"Disciplines"},
 *     path="/disciplines/{id}",
 *     @OA\Response(response="200", description="Delete discipline by id")
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