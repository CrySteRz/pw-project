<?php

declare(strict_types=1);

namespace App\Controller\User;

use Slim\Http\Request;
use Slim\Http\Response;


 /**
 * @OA\Get(
 *     tags={"Users"},
 *     path="/users/student",
 *     @OA\Response(response="200", description="Get all students")
 * )
 */
final class GetAllStudents extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $message = [
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }
}