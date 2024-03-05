<?php

declare(strict_types=1);

namespace App\Controller\Discipline;

use App\Controller\BaseController;
use App\Exception\Discipline;
use App\Service\Discipline\DisciplineService;


abstract class Base extends BaseController
{
    protected function getDisciplineService(): DisciplineService
    {
        return $this->container->get('discipline_service');
    }

    /**
     * @param array<object> $input
     */
    protected function getAndValidateUserId(array $input): int
    {
        // if (isset($input['decoded']) && isset($input['decoded']->sub)) {
        //     return (int) $input['decoded']->sub;
        // }

        // throw new User('Invalid user. Permission failed.', 400);

        return "1234567890";
    }
}