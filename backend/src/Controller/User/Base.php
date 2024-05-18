<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
use App\Exception\User;
use App\Service\UserService;
use App\Service\DisciplineService;
use App\Service\GradeService;

abstract class Base extends BaseController
{
    protected function getUserService(): UserService
    {
        return $this->container->get('user_service');
    }

    protected function getDisciplineService(): DisciplineService 
    {
        return $this->container->get('discipline_service');
    }

    protected function getGradeService(): GradeService 
    {
        return $this->container->get('grade_service');
    }

    protected function getLoginUserService(): Login
    {
        return $this->container->get('login_user_service');
    }

    protected function checkUserPermissions(
        int $userId,
        int $userIdLogged
    ): void {
        if ($userId !== $userIdLogged) {
            throw new User('User permission failed.', 400);
        }
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