<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Discipline;

final class DisciplineRepository extends BaseRepository
{
    /**
     * @return array<string>
     */
    public function getAllDisciplines(): array
    {
        $query = 'SELECT * FROM `Discipline` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
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
}