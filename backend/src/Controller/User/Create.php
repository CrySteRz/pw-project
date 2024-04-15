<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;



final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $user = $request->getParsedBody();
        // $data = json_decode($json, true); 
        $createdUser = $this->getUserService()->Create($user);

        return $this->jsonResponse($response, 'success', $createdUser, 200);
    }
}