<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $discipline = $this->getDisciplineService()->create($input)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}