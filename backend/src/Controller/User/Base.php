<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\BaseController;
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
}