<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Grade;
use App\Dtos\GradeDto;

final class GradeRepository extends BaseRepository
{

    public function getFiltered(?string $student_email = null, ?string $teacher_email = null): array
    {
        $query = 'SELECT Grade.value, Student.email AS student_email, Teacher.email AS teacher_email,
                    Exam.examDate AS exam_examDate, Discipline.name AS discipline_name, Discipline.credits AS discipline_credits
                    FROM `Grade`
                    INNER JOIN User AS Student ON Grade.idUser = Student.id
                    INNER JOIN Exam ON Grade.idExam = Exam.id
                    INNER JOIN Discipline ON Exam.idDiscipline = Discipline.id
                    INNER JOIN users_has_disciplines UHD ON Discipline.id = UHD.id_discipline
                    INNER JOIN User AS Teacher ON UHD.id_user = Teacher.id';
        $params = [];
        $conditions = [];

        if ($student_email) {
            $conditions[] = 'Student.email = :student_email';
            $params[':student_email'] = $student_email;
        }

        if ($teacher_email) {
            $conditions[] = 'Teacher.email = :teacher_email';
            $params[':teacher_email'] = $teacher_email;
        }

        if ($conditions) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $query .= ' GROUP BY student_email, discipline_name, exam_examDate, Grade.value, discipline_credits';
        $query .= ' ORDER BY Grade.id';
        $statement = $this->getDb()->prepare($query);
        $statement->execute($params);
        $grades =  $statement->fetchAll();
        $gradeDtos = [];
        foreach ($grades as $grade) {
            $gradeDtos[] = $this->buildGradeDto($grade);
        }
        return $gradeDtos;
    }


    public function FillGradesForExam($exam){
        // Fetch all users that are students
        $query = "SELECT id FROM User WHERE roleId = 3";
        $statement = $this->getDb()->prepare($query);
        $statement->execute();
        $students = $statement->fetchAll();

        // Insert a new row into the grades table for each student
        $query = "INSERT INTO Grade (idUser, idExam, value) VALUES (:userId, :idExam, :value)";
        $statement = $this->getDb()->prepare($query);
        $idExam = $exam->getId();
        $value = 0;
        $statement->bindParam(':idExam', $idExam);
        $statement->bindParam(':value', $value);

        
        foreach ($students as $studentId) {
            $id_stud = $studentId['id'];
            $statement->bindParam(':userId', $id_stud);
            $statement->execute();
        }
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

    private function buildGradeDto(array $grade): GradeDto
    {

        $gradeDto = new GradeDto();
        $gradeDto->setEmail($grade['student_email']);
        $gradeDto->setExamDate($grade['exam_examDate']);
        $gradeDto->setDisciplineName($grade['discipline_name']);
        $gradeDto->setGradeValue(intval($grade['value']));
        $gradeDto->setCredits(intval($grade['discipline_credits']));
        return $gradeDto;
    }

}