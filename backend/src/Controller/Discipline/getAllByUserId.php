<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use Slim\Http\Request;
use Slim\Http\Response;
/**
 * @OA\Get(
 *     tags={"Disciplines"},
 *     path="/disciplines/student/{stud_id}",
 *     summary="Get all disciplines of a student",
 *     description="Retrieves a list of all disciplines associated with the specified student.",
 *     @OA\Parameter(
 *         name="stud_id",
 *         in="path",
 *         required=true,
 *         description="ID of the student",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of all disciplines for the specified student",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Discipline")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Student not found"
 *     )
 * )
 */
final class getAllByUserId extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $studentId= intval($args["stud_id"]);
        $disciplines = $this->getDisciplineService()->getAllByUserId($studentId);
        return $this->jsonResponse($response, 'success', $disciplines, 200);
    }
}