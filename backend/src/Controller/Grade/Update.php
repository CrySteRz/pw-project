<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $updateGradeDto = $request->getParsedBody();
        $new_grade = $updateGradeDto['new_grade'];
        $grade_id = $updateGradeDto['grade_id'];
        $this->getGradeService()->PatchGrade($new_grade, $grade_id);
        return $this->jsonResponse($response, 'success', $updateGradeDto, 200);
    }
}