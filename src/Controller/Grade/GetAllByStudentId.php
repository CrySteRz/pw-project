<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     tags={"Grades"},
 *     path="/grades/student/{stud_id}",
 *     @OA\Response(response="200", description="Get all grades of a student")
 * )
 */
final class GetAllByStudentId extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $studentId= intval($args["stud_id"]);
        $disciplines = $this->getGradeService()->getAllByUserId($studentId);
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}