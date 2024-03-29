<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Grade;

final class GradeRepository extends BaseRepository
{
    /**
     * @return array<string>
     */
    public function getAllGrades(): array
    {
        $query = 'SELECT * FROM `Grade` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        return (array) $statement->fetchAll();
    }

    public function getAllGradesByUserId(int $userId) : array
    {
        $query = "SELECT * FROM Grade WHERE idUser = :userId";
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':userId', $userId);
        $statement->execute();
        $grades = $statement->fetchAll();
        return $grades;
    }

    public function getOne(int $studentId,int $examId) : Grade
    {
        $query = "SELECT * FROM Grade WHERE idUser = :idUser AND idExam = :idExam";
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':idUser', $studentId);
        $statement->bindParam(':idExam', $examId);
        $statement->execute();
        $grade = $statement->fetchObject(Grade::class);
        // if (! $grade) {
        //     throw new \App\Exception\Grade('Task not found.', 404);
        // }

        return $grade;
    }

    public function create(Grade $grade): Grade
    {
        $query = "INSERT INTO Grade (idExam, idUser, value) VALUES (:idExam, :idUser, :value)";
        $idExam = $grade->getIdExam();
        $idUser = $grade->getIdUser();
        $value = $grade->getValue();
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':idExam', $idExam);
        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':value', $value);
        $statement->execute();
        $grade->updateId(intval($this->getDb()->lastInsertId()));
        return $grade;
    }

    public function update(Grade $grade, int $gradeId): Grade
    {
        $query = "UPDATE Grade SET idExam = :idExam, idUser = :idUser, value = :value WHERE id = :gradeId";
        $idExam = $grade->getIdExam();
        $idUser = $grade->getIdUser();
        $value = $grade->getValue();
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':idExam', $idExam);
        $statement->bindParam(':idUser', $idUser);
        $statement->bindParam(':value', $value);
        $statement->bindParam(':gradeId', $gradeId);
        $statement->execute();
        return $grade;
    }

    public function delete(int $gradeId): void
    {
        $query = 'DELETE FROM `grade` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $gradeId);
        $statement->execute();
    }
}