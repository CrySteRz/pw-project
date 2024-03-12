<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;
 /**
 * @OA\Post(
 *     tags={"Disciplines"},
 *     path="/disciplines/create",
 *     @OA\Response(response="200", description="Create a new discipline")
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