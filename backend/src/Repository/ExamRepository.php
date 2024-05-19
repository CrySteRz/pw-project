<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Exam;


final class ExamRepository extends BaseRepository
{


public function create(Exam $exam): Exam
    {
        $query = 'INSERT INTO Exam (examDate, idDiscipline) VALUES (:examDate, :idDiscipline)';
        $statement = $this->getDb()->prepare($query);
    
        $examDate = $exam->getExamDate()->format('Y-m-d H:i:s');
        $disciplineId = $exam->getIdDiscipline();
    
        $statement->bindParam(':examDate', $examDate);
        $statement->bindParam(':idDiscipline', $disciplineId);
    
        $statement->execute();
    
        $exam->setId((int)$this->getDb()->lastInsertId());
        return $exam;
    }

   

}