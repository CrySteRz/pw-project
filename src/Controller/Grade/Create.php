<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;
  /**
 * @OA\Post(
 *     tags={"Grades"},
 *     path="/create",
 *     @OA\Response(response="200", description="Get grade of a student at an exam")
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