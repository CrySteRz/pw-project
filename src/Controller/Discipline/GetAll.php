<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        //TODO: add pagination 
        // $userId = $this->getAndValidateUserId($input);
        $disciplines = $this->getDisciplineService()->getAll();

        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}