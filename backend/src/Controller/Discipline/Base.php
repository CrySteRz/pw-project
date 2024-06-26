<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use App\Controller\BaseController;
use App\Exception\Discipline;
use App\Service\DisciplineService;

/**
 * @OA\Server(url="http://localhost:8081")
 * @OA\Info(
 *     title="New StudentWeb",
 *     version="1.0.0",
 *     description="API for maintaining and showing academic status at the university"
 * )
 */
abstract class Base extends BaseController
{
    protected function getDisciplineService(): DisciplineService
    {
        
        return $this->container->get('discipline_service');
    }
}