<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

final class UserRepository extends BaseRepository
{
  
    public function GetStudentByEmail(string $email): User
    {
        $query = 'SELECT * FROM `User` WHERE `email` = :email';
        $statement = $this->getDb()->prepare($query);
        $statement->bindValue('email', $email);
        $statement->execute();
        $user = $statement->fetch();

        if (!$user) {
            return null;
        }
        return $this->buildUser($user);
    }

    private function buildUser(array $row): User
    {
        $user = new User();
        $user->updateEmail($row['email']);
        $user->updateRoleId((int)$row['roleId']);
        $user->updateName($row['name']);
        $user->updateSurname($row['surname']);
        $user->updateBirthDate(new \DateTime($row['birthDate']));
        $user->updateCountry($row['country']);
        $user->updateState($row['state']);
        $user->updateCity($row['city']);
        $user->updateAddress($row['address']);
        $user->updateSex((bool)$row['sex']);
        $user->updateCNP($row['CNP']);
        return $user;
    }
  
}