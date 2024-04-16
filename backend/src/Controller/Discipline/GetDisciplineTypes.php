<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;



final class GetDisciplineTypes extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {

        $disciplines = $this->getDisciplineService()->GetDisciplineTypes();

        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}