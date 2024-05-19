<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use App\Controller\BaseController;
use App\Service\GradeService;

abstract class Base extends BaseController
{
    protected function getGradeService(): GradeService
    {
        return $this->container->get('grade_service');
    }
}