<?php

declare(strict_types=1);

namespace App\Service\Discipline;

use App\Entity\Discipline;
use App\Repository\DisciplineRepository;
use App\Service\BaseService;
// use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{

    public function __construct(
        protected DisciplineRepository $disciplineRepository
    ) {
    }

    protected function getDisciplineRepository(): DisciplineRepository
    {
        return $this->disciplineRepository;
    }

    // protected static function validateDisciplineName(string $name): string
    // {
    //     if (! v::length(1, 100)->validate($name)) {
    //         throw new \App\Exception\Discipline('Invalid name.', 400);
    //     }

    //     return $name;
    // }

    // protected static function validateDisciplineStatus(int $status): int
    // {
    //     if (! v::numeric()->between(0, 1)->validate($status)) {
    //         throw new \App\Exception\Discipline('Invalid status', 400);
    //     }

    //     return $status;
    // }

    protected function getDisciplineFromDb(int $DisciplineId, int $userId): Discipline
    {
        return $this->getDisciplineRepository()->checkAndGetDiscipline($DisciplineId, $userId);
    }

}