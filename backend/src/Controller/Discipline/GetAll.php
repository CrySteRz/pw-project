<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;


/**
 * @OA\Get(
 *     tags={"Disciplines"},
 *     path="/disciplines/",
 *     summary="Get all disciplines",
 *     description="Retrieves a list of all disciplines.",
 *     @OA\Response(
 *         response=200,
 *         description="List of all disciplines",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Discipline")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */
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