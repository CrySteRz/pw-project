<?php

declare(strict_types=1);

namespace App\Repository;

use App\Dtos\UserData;

final class UserRepository extends BaseRepository
{
    public function getUserByEmail(string $email): UserData
    {
        $query = 'SELECT * FROM `User` WHERE `email` = :email';
        $statement = $this->getDb()->prepare($query);
        $statement->bindValue('email', $email);
        $statement->execute();
        $user = $statement->fetch();
        if (!$user || empty($user)) {
            return new UserData();
        }
        return $this->buildUser($user);
    }

    public function getAllStudents() : array {
        $query = 'SELECT * FROM `User` WHERE `roleId` = 3';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        
        if (!$users || empty($users)) {
            return [];
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

        if (!$users || empty($users)) {
            return [];
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

    public function Update($user, $email) : void
{
    $sql = "UPDATE User SET 
            email = :email,
            name = :name,
            surname = :surname,
            birthDate = :birthDate,
            country = :country,
            state = :state,
            city = :city,
            address = :address,
            sex = :sex,
            CNP = :CNP,
            roleId = :roleId
            WHERE email = :oldEmail";
    
    $user = $this->buildUser($user);
    $stmt = $this->getDb()->prepare($sql);
    $stmt->bindParam(':email', $user->email);
    $stmt->bindParam(':name', $user->name);
    $stmt->bindParam(':surname', $user->surname);
    $stmt->bindParam(':birthDate', $user->birthDate);
    $stmt->bindParam(':country', $user->country);
    $stmt->bindParam(':state', $user->state);
    $stmt->bindParam(':city', $user->city);
    $stmt->bindParam(':address', $user->address);
    $stmt->bindParam(':sex', $user->sex, \PDO::PARAM_BOOL);
    $stmt->bindParam(':CNP', $user->CNP);
    $stmt->bindParam(':roleId', $user->roleId, \PDO::PARAM_INT);
    $stmt->bindParam(':oldEmail', $email);
    $stmt->execute();
    
}
    public function Delete($email) : void
    {
        $user = $this->GetUserByEmail($email);
        $sql = "DELETE FROM User WHERE email = :email";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        
    }


    private function buildUser(array $row): UserData
    {
        $user = new UserData();
        if (isset($row['id']))
        $user->setId((int)$row['id']);
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
        if (isset($row['google_id'])) {
            $user->updateGoogleId($row['google_id']);
        }
        return $user;
    }
  
}