<?php

declare(strict_types=1);

namespace App\Service\Grade;

use App\Entity\Grade;
use App\Repository\GradeRepository;
use App\Service\BaseService;

abstract class Base extends BaseService
{

    public function __construct(
        protected GradeRepository $gradeRepository
    ) {
    }

    protected function getGradeRepository(): GradeRepository
    {
        return $this->gradeRepository;
    }

}