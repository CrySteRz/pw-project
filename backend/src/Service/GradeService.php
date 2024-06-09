<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Grade;
use App\Exception\Grade as GradeException;
use App\Repository\GradeRepository;

final class GradeService extends Base
{
    public function __construct(
        protected GradeRepository $gradeRepository
    ) {
    }

    /**
     * @return array<string>
     */
    public function getFiltered(?string $student_email = null, ?string $teacher_email = null): array
    {
        return $this->getGradeRepository()->getFiltered($student_email, $teacher_email);
    }

    public function getOne(int $studentId,int $examId): object
    {
        $grade = $this->getGradeRepository()->getOne($studentId, $examId);
        return $grade;
    }

    public function PatchGrade($new_grade, $grade_id){
        $this->getGradeRepository()->PatchGrade($new_grade, $grade_id);
    }

    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        $grade = $this->createGrade($data);
        $grade = $this->getGradeRepository()->create($grade);
        return $grade;
    }

    public function createGrade(object $data): Grade
    {
        // TODO: validate the data before creating the entity
         $grade = new Grade();
         $grade->updateIdExam($data->idExam);
         $grade->updateIdUser($data->idUser);
         $grade->updateValue($data->value);  
         return $grade;
    }

    /**
     * @param array<string> $input
     */
    public function update(array $input, int $gradeId): object
    {
        $data = $this->validateGrade($input, $gradeId);
        $grade = $this->getGradeRepository()->update($data, $gradeId);
        return $grade;
    }

    public function delete(int $gradeId): Grade
    {
        // TODO: this throws an exception if the grade does not exist because getOne returns bool.
        // add Grade class for error handling
        $grade = $this->getGradeRepository()->getOne($gradeId);
        $this->getGradeRepository()->delete($gradeId);
        return $grade;
    }

    private function validateGrade(array $input, int $gradeId): Grade
    {
        //TODO: validate data here
        $grade = $this->getGradeRepository()->getOne($gradeId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->idExam)) {
            $grade->updateIdExam($data->idExam);
        }
        if (isset($data->idUser)) {
            $grade->updateIdUser($data->idUser);
        }
        if (isset($data->value)) {
            $grade->updateValue($data->value);
        }
        return $grade;
    }

    public function updateWithCsv($csvData) {
        return $this->getGradeRepository()->updateWithCsv($csvData);
    }

}