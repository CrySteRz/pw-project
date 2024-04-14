<?php

declare(strict_types=1);

namespace App\Controller\Grade;

use App\Controller\BaseController;
use App\Service\Grade\GradeService;

abstract class Base extends BaseController
{
    protected function getGradeService(): GradeService
    {
        return $this->container->get('grade_service');
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