<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

 /**
 * @OA\Get(
 *     tags={"Grades"},
 *     path="/grades/student/{stud_id}/exam/{exam_id}",
 *     @OA\Response(response="200", description="Get grade of a student at an exam")
 * )
 */
final class GetOne extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $studentId= intval($args["stud_id"]);
        $exam_id= intval($args["exam_id"]);
        $disciplines = $this->getGradeService()->getOne($studentId, $exam_id)->toJson();
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}