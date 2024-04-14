<?php

declare(strict_types=1);

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use OpenApi\Serializer;
final class DefaultController extends BaseController
{
    private const API_VERSION = '1.0';


/**
 * @OA\Get(
 *     path="/",
 *     summary="Get API version information",
 *     description="Gets the current version of the API along with the timestamp.",
 *     @OA\Response(
 *         response=200,
 *         description="Successful response",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="version", type="string", example="1.0.0"),
 *             @OA\Property(property="timestamp", type="integer", example=1646744833)
 *         )
 *     )
 * )
 */
    public function getHelp(Request $request, Response $response): Response
    {
        $message = [
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }

    public function getStatus(Request $request, Response $response): Response
    {
        $status = [
            'SQLite' => 'OK',
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $status, 200);
    }

    /**
     * @return array<int>
     */
    private function getDbStats(): array
    {
        $taskService = $this->container->get('task_service');
        $userService = $this->container->get('find_user_service');
        $noteService = $this->container->get('find_note_service');

        return [
            'tasks' => count($taskService->getAllTasks()),
            'users' => count($userService->getAll()),
            'notes' => count($noteService->getAll()),
        ];
    }

    public function getOpenApiDefinition(Request $request, Response $response): Response
{
    // Assuming you have the OpenAPI definition in a JSON file or string. You need to retrieve it first.
    // For example, if you have a JSON file, you might use file_get_contents to get the JSON string.
    // Replace '/path/to/your/openapi.json' with the actual path to your OpenAPI JSON file.
    $jsonString = file_get_contents( __DIR__ . '/../../util/openapi.json');

    // Check if $jsonString is actually retrieved and not false or null
    if ($jsonString === false) {
        // Handle the error, maybe return an error response or throw an exception
        return $this->jsonResponse($response, 'error', 'Failed to retrieve OpenAPI definition.', 400);
    }

    $serializer = new Serializer();
    try {
        $openapi = $serializer->deserialize($jsonString, 'OpenApi\Annotations\OpenApi');
        return $this->jsonResponse($response, 'success', json_decode($openapi->toJson()), 200);
    } catch (\Exception $e) {
        // Handle deserialization error, maybe log it and return an error response
        return $this->jsonResponse($response, 'error', 'Failed to deserialize OpenAPI definition.', 400);
    }
}

}