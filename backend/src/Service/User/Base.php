<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\BaseService;

abstract class Base extends BaseService
{

    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    protected function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

}