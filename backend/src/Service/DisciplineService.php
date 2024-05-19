<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Discipline;
use App\Exception\Discipline as DisciplineException;
use App\Repository\DisciplineRepository;
use App\Entity\Exam;
use App\Repository\ExamRepository;
use App\Entity\Grade;
use App\Repository\GradeRepository;
final class DisciplineService extends Base
{
    public function __construct(
        protected DisciplineRepository $disciplineRepository,
        protected ExamRepository $examRepository,
        protected GradeRepository $gradeRepository
    ) {
    }

    protected function getDisciplineRepository(): DisciplineRepository
    {
        return $this->disciplineRepository;
    }
 
    /**
     * @return array<string>
     */
    public function getFiltered(?string $student_email, ?string $teacher_email): array
    {
        return $this->getDisciplineRepository()->getFiltered($student_email, $teacher_email);
    }

    public function getOne(int $disciplineId): object
    {
        $discipline = $this->getDisciplineRepository()->getOne($disciplineId);
        return $discipline;
    }

    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        $data->examDate = new \DateTime($data->examDate);
        $discipline = $this->createDiscipline($data);
        $discipline = $this->getDisciplineRepository()->create($discipline);
        $this->getDisciplineRepository()->AddTeacher($data->teacher_email, $discipline->getId());
        $exam = new Exam();
        $exam->updateExamDate($data->examDate);
        $exam->updateIdDiscipline($discipline->getId());
        $exam = $this->getExamRepository()->create($exam);
        $this->getGradeRepository()->FillGradesForExam($exam);

        return $discipline;
    }

    public function createDiscipline(object $data): Discipline
    {
        // TODO: validate the data before creating the entity
         $discipline = new Discipline();
         $discipline->updateName($data->name);
         $discipline->updateCredits($data->credits);
         $discipline->updateIdDiscipline($data->idDiscipline);  
         return $discipline;
    }

    /**
     * @param array<string> $input
     */
    public function update(array $input, int $disciplineId): object
    {
        $data = $this->validateDiscipline($input, $disciplineId);
        $discipline = $this->getDisciplineRepository()->update($data, $disciplineId);
        return $discipline;
    }

    public function delete(int $disciplineId): Discipline
    {
        // TODO: this throws an exception if the discipline does not exist because getOne returns bool.
        // add Discipline class for error handling
        $discipline = $this->getDisciplineRepository()->getOne($disciplineId);
        $this->getDisciplineRepository()->delete($disciplineId);
        return $discipline;
    }

    private function validateDiscipline(array $input, int $disciplineId): Discipline
    {
        //TODO: validate data here
        $discipline = $this->getDisciplineRepository()->getOne($disciplineId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $discipline->updateName($data->name);
        }
        if (isset($data->credits)) {
            $discipline->updateCredits($data->credits);
        }
        if (isset($data->idDiscipline)) {
            $discipline->updateIdDiscipline($data->idDiscipline);
        }
        return $discipline;
    }

    public function getDisciplinesByUserEmail(string $email): array
    {
        return $this->getDisciplineRepository()->getDisciplinesByUserEmail($email);
    }

    public function GetDisciplineTypes(): array
    {
        return $this->getDisciplineRepository()->GetDisciplineTypes();
    }
}