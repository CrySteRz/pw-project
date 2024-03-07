<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $id = (int) $args['id'];
        $discipline = $this->getDisciplineService()->update($input, $id)->toJson();
        return $this->jsonResponse($response, 'success', $discipline, 200);
    }
}