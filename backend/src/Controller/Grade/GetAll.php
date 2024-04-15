<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $disciplines = $this->getGradeService()->getAll();
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}