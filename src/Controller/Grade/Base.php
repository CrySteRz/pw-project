<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Exception\User;
use App\Service\User\Create;
use App\Service\User\Delete;
use App\Service\User\Find;
use App\Service\User\Login;
use App\Service\User\Update;

abstract class Base extends BaseController
{
    protected function getGradeService(): Find
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