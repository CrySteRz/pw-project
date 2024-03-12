<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;
   /**
 * @OA\Put(
 *     tags={"Grades"},
 *     path="/{id}",
 *     @OA\Response(response="200", description="Update a grade by id")
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