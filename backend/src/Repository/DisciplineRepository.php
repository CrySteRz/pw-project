<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Discipline;
use App\Dtos\DisciplineTypeDto;

final class DisciplineRepository extends BaseRepository
{
    /**
     * @return array<string>
     */
    public function getFiltered(?string $student_email = null, ?string $teacher_email = null): array
    {
        $query = 'SELECT DISTINCT D.* FROM `Discipline` D
        LEFT JOIN `users_has_disciplines` UHD ON D.id = UHD.id_discipline
        LEFT JOIN `User` U ON UHD.id_user = U.id';
        $params = [];
        $conditions = [];

        if ($student_email) {
        $conditions[] = 'U.email = :student_email AND U.roleId = :student_roleId';
        $params[':student_email'] = $student_email;
        $params[':student_roleId'] = 3; // Assuming 1 is the roleId for students
        }

        if ($teacher_email) {
        $conditions[] = 'U.email = :teacher_email AND U.roleId = :teacher_roleId';
        $params[':teacher_email'] = $teacher_email;
        $params[':teacher_roleId'] = 2; // Assuming 2 is the roleId for teachers
        }

        if ($conditions) {
        $query .= ' WHERE ' . implode(' OR ', $conditions);
        }

        $query .= ' ORDER BY D.id';


        $statement = $this->getDb()->prepare($query);
        $statement->execute($params);
        return (array) $statement->fetchAll();
    }

    public function getAllDisciplinesByUserId(int $userId) : array
    {
        $query = "SELECT d.* FROM users_has_disciplines ud
                  INNER JOIN Discipline d ON ud.id_discipline = d.id
                  WHERE ud.id_user = :userId";
        $db = $this->getDb();
        $statement = $db->prepare($query);
        $statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $statement->execute();
        $entries = $statement->fetchAll(Discipline::class);
        return $entries;
    }

    public function getOne(int $id) : Discipline
    {
        $query = "SELECT * FROM Discipline WHERE id = :id";
        $statement = $this->getDb()->prepare($query);
        $statement->execute(['id' => $id]);
        $discipline = $statement->fetchObject(Discipline::class);
        // if (! $discipline) {
        //     throw new \App\Exception\Discipline('Task not found.', 404);
        // }

        return $discipline;
    }

    public function create(Discipline $discipline): Discipline
    {
        $query = "INSERT INTO Discipline (name, idDiscipline, credits) VALUES (:name, :idDiscipline, :credits)";
        $idDiscipline = $discipline->getIdDiscipline();
        $name = $discipline->getName();
        $credits = $discipline->getCredits();
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':idDiscipline', $idDiscipline);
        $statement->bindParam(':credits', $credits);
        $statement->execute();
        $discipline->updateId(intval($this->getDb()->lastInsertId()));
        return $discipline;
    }

    public function AddTeacher($teacher_email, $disciplineId){
        // Get the userId associated with the teacher_email
        $query = "SELECT id FROM User WHERE email = :email";
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':email', $teacher_email);
        $statement->execute();
        $userId = $statement->fetchColumn();

        // Insert a new row into the users_has_disciplines table
        $query = "INSERT INTO users_has_disciplines (id_user, id_discipline) VALUES (:userId, :disciplineId)";
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':disciplineId', $disciplineId);
        $statement->execute();
    }

    public function update(Discipline $discipline, int $disciplineId): Discipline
    {
        $query = "UPDATE Discipline SET name = :name, idDiscipline = :idDiscipline, credits = :credits WHERE id = :disciplineId";
        $statement = $this->getDb()->prepare($query);
        $name = $discipline->getName();
        $idDiscipline = $discipline->getIdDiscipline();
        $credits = $discipline->getCredits();
        $statement->bindParam(':name', $name);
        $statement->bindParam(':idDiscipline', $idDiscipline);
        $statement->bindParam(':credits', $credits);
        $statement->bindParam(':disciplineId', $disciplineId);
        $statement->execute();
        return $discipline;
    }

    public function delete(int $disciplineId): void
    {
        $query = 'DELETE FROM `discipline` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $disciplineId);
        $statement->execute();
    }

    public function getDisciplinesByUserEmail(string $email): array
    {
        $getUserQuery = "SELECT id FROM User WHERE email = :email";
        $getDisciplinesIdsQuery = "SELECT id_discipline FROM users_has_disciplines WHERE id_user = :userId";
        $getDisciplinesQuery = "SELECT * FROM Discipline WHERE id IN (%s)";

        // Get userId from User table
        $stmt = $this->getDb()->prepare($getUserQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception("User not found");
        }

        $userId = $user['id'];

        // Get id_discipline from users_has_disciplines table
        $stmt = $this->getDb()->prepare($getDisciplinesIdsQuery);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        $disciplinesIds = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        if (!$disciplinesIds) {
            return [];
        }

        // Get all rows from Discipline table
        $placeholders = str_repeat('?,', count($disciplinesIds) - 1) . '?';
        $stmt = $this->getDb()->prepare(sprintf($getDisciplinesQuery, $placeholders));
        $stmt->execute($disciplinesIds);
        $disciplines = $stmt->fetchAll();
        return $disciplines;
    }

    public function getDisciplineTypes(): array
    {
        $sql = "SELECT * FROM DisciplineType";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
    
        $disciplineTypes = [];
        while ($row = $stmt->fetch()) {
            $disciplineTypeDto = new DisciplineTypeDto();
            $disciplineTypeDto->setId(intval($row['id']));
            $disciplineTypeDto->setType($row['type']);
            $disciplineTypes[] = $disciplineTypeDto;
        }
    
        return $disciplineTypes;
    }

}