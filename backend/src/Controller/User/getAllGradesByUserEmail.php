<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


final class getAllGradesByUserEmail extends Base
{
    // example: http://localhost:8081/students/grades?email=user1@example.com
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $email= $request->getQueryParams()['email'];
        $grades =  $this->getGradeService()->getAllGradesByUserEmail($email);
        return $this->jsonResponse($response, 'success', $grades, 200);
    }
}