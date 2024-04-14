<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exception\User as UserException;
use App\Repository\UserRepository;

final class UserService extends Base
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }


    public function GetStudentByEmail(string $email): User
    {
        return $this->getUserRepository()->GetStudentByEmail($email);
    }


}