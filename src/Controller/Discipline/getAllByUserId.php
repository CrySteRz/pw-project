<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;
 /**
 * @OA\Get(
 *     tags={"Disciplines"},
 *     path="/disciplines/student/{stud_id}",
 *     @OA\Response(response="200", description="Get all disciplines of a student")
 * )
 */

final class getAllByUserId extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $studentId= intval($args["stud_id"]);
        $disciplines = $this->getDisciplineService()->getAllByUserId($studentId);
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}