<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dtos\UserData;

final class UserRepository extends BaseRepository
{
  
    public function GetStudentByEmail(string $email): UserData
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

    public function getAllStudents() : array {
        $query = 'SELECT * FROM `User` WHERE `roleId` = 3';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();

        if (!$users) {
            return null;
        }
        $students = [];
        foreach ($users as $user) {
            $students[] = $this->buildUser($user);
        }
        return $students;
    }

    public function getAllTeachers() : array {
        $query = 'SELECT * FROM `User` WHERE `roleId` = 2';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();

        if (!$users) {
            return null;
        }
        $students = [];
        foreach ($users as $user) {
            $students[] = $this->buildUser($user);
        }
        return $students;
    }

    public function Create($user) : UserData
    {
        $sql = "INSERT INTO User (email, name, surname, birthDate, country, state, city, address, sex, CNP, roleId) 
         VALUES (:email, :name, :surname, :birthDate, :country, :state, :city, :address, :sex, :CNP, :roleId)";

        $stmt = $this->getDb()->prepare($sql);
    
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':name', $user['name']);
        $stmt->bindParam(':surname', $user['surname']);
        $stmt->bindParam(':birthDate', $user['birthDate']);
        $stmt->bindParam(':country', $user['country']);
        $stmt->bindParam(':state', $user['state']);
        $stmt->bindParam(':city', $user['city']);
        $stmt->bindParam(':address', $user['address']);
        $stmt->bindParam(':sex', $user['sex'], \PDO::PARAM_BOOL);
        $stmt->bindParam(':CNP', $user['CNP']);
        $stmt->bindParam(':roleId', $user['roleId'], \PDO::PARAM_INT);
    
        $stmt->execute();
    
        $user['id'] = $this->getDb()->lastInsertId();
    
        return $this->buildUser($user); 
    }

    private function buildUser(array $row): UserData
    {
        $user = new UserData();
        $user->updateEmail($row['email']);
        $user->updateRoleId((int)$row['roleId']);
        $user->updateName($row['name']);
        $user->updateSurname($row['surname']);
        $user->updateBirthDate((new \DateTime($row['birthDate']))->format('c'));
        $user->updateCountry($row['country']);
        $user->updateState($row['state']);
        $user->updateCity($row['city']);
        $user->updateAddress($row['address']);
        $user->updateSex((bool)$row['sex']);
        $user->updateCNP($row['CNP']);
        return $user;
    }
    
  
}