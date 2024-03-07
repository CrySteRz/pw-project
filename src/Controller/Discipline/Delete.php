<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $disciplineId= intval($args["id"]);
        $discipline = $this->getDisciplineService()->delete($disciplineId)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}