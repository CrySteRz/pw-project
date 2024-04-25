<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


final class Update extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $user = $request->getParsedBody();
        $email= $request->getQueryParams()['email'];
        $createdUser = $this->getUserService()->Update($user, $email);
        return $this->jsonResponse($response, 'success', $createdUser, 200);
    }
}