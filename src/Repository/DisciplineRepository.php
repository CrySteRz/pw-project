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
        $query = 'SELECT * FROM `Disciplines` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        return (array) $statement->fetchAll();
    }

    public function create(Discipline $Discipline): Discipline
    {
        // $query = '
        //     INSERT INTO `Disciplines`
        //         (`name`, `description`, `status`, `userId`)
        //     VALUES
        //         (:name, :description, :status, :userId)
        // ';
        // $statement = $this->getDb()->prepare($query);
        // $name = $Discipline->getName();
        // $desc = $Discipline->getDescription();
        // $status = $Discipline->getStatus();
        // $userId = $Discipline->getUserId();
        // $statement->bindParam('name', $name);
        // $statement->bindParam('description', $desc);
        // $statement->bindParam('status', $status);
        // $statement->bindParam('userId', $userId);
        // $statement->execute();

        // $DisciplineId = (int) $this->database->lastInsertId();

        // return $this->checkAndGetDiscipline($DisciplineId, (int) $userId);
    }

    public function update(Discipline $Discipline): Discipline
    {
        // $query = '
        //     UPDATE `Disciplines`
        //     SET `name` = :name, `description` = :description, `status` = :status
        //     WHERE `id` = :id AND `userId` = :userId
        // ';
        // $statement = $this->getDb()->prepare($query);
        // $id = $Discipline->getId();
        // $name = $Discipline->getName();
        // $desc = $Discipline->getDescription();
        // $status = $Discipline->getStatus();
        // $userId = $Discipline->getUserId();
        // $statement->bindParam('id', $id);
        // $statement->bindParam('name', $name);
        // $statement->bindParam('description', $desc);
        // $statement->bindParam('status', $status);
        // $statement->bindParam('userId', $userId);
        // $statement->execute();

        // return $this->checkAndGetDiscipline((int) $id, (int) $userId);
    }

    public function delete(int $DisciplineId, int $userId): void
    {
        // $query = 'DELETE FROM `Disciplines` WHERE `id` = :id AND `userId` = :userId';
        // $statement = $this->getDb()->prepare($query);
        // $statement->bindParam('id', $DisciplineId);
        // $statement->bindParam('userId', $userId);
        // $statement->execute();
    }
}