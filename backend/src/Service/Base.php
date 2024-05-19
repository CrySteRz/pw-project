<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Discipline;
use App\Repository\DisciplineRepository;
use App\Service\BaseService;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Grade;
use App\Repository\GradeRepository;
use App\Entity\Exam;
use App\Repository\ExamRepository;


abstract class Base extends BaseService
{

    public function __construct(
        protected DisciplineRepository $disciplineRepository,
        protected ExamRepository $examRepository
    ) {
    }

    protected function getDisciplineRepository(): DisciplineRepository
    {
        return $this->disciplineRepository;
    }

    protected function getGradeRepository(): GradeRepository
    {
        return $this->gradeRepository;
    }

    protected function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    protected function getExamRepository(): ExamRepository
    {
        return $this->examRepository;
    }
}