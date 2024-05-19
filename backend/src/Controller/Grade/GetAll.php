<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $student_email= $request->getQueryParams()['student_email'] ?? null;
        $teacher_email= $request->getQueryParams()['teacher_email'] ?? null;
        $disciplines = $this->getGradeService()->getFiltered($student_email, $teacher_email);
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}