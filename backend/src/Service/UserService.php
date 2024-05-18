<?php

declare(strict_types=1);

namespace App\Service;

use App\Dtos\UserData;
use App\Exception\User as UserException;
use App\Repository\UserRepository;

final class UserService extends Base
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function getUserByEmail(string $email): UserData
    {
        return $this->getUserRepository()->getUserByEmail($email);
    }

    public function getAllStudents() : array 
    {
        return $this->getUserRepository()->getAllStudents();
    }

    
    public function getAllTeachers() : array 
    {
        return $this->getUserRepository()->getAllTeachers();
    }

    public function Create($user) : UserData
    {
        return $this->getUserRepository()->Create($user);
    }

    public function Update($user, $email)
    {
        return $this->getUserRepository()->Update($user, $email);
    }

    public function Delete($email)
    {
        return $this->getUserRepository()->Delete($email);
    }

}