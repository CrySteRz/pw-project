<?php

declare(strict_types=1);

namespace App\Dtos;

/**
 * @OA\Schema(
 *     schema="GradeDTO",
 *     required={"id", "email", "examDate", "disciplineName", "gradeValue", "credits"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="The unique identifier of the grade"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="The email of the student"
 *     ),
 *     @OA\Property(
 *         property="examDate",
 *         type="string",
 *         format="date",
 *         description="The date of the exam"
 *     ),
 *     @OA\Property(
 *         property="disciplineName",
 *         type="string",
 *         description="The name of the discipline"
 *     ),
 *     @OA\Property(
 *         property="gradeValue",
 *         type="integer",
 *         format="int64",
 *         description="The value of the grade"
 *     ),
 *     @OA\Property(
 *         property="credits",
 *         type="integer",
 *         format="int64",
 *         description="The number of credits"
 *     )
 * )
 */

final class GradeDto
{

    public int $id;
    public string $email;
    public string $examDate;
    public string $disciplineName;
    public int  $gradeValue;
    public int $credits;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getExamDate(): string
    {
        return $this->examDate;
    }

    public function getDisciplineName(): string
    {
        return $this->disciplineName;
    }

    public function getGradeValue(): int
    {
        return $this->gradeValue;
    }

    public function getCredits(): int
    {
        return $this->credits;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setExamDate(string $examDate): self
    {
        $this->examDate = $examDate;
        return $this;
    }

    public function setDisciplineName(string $disciplineName): self
    {
        $this->disciplineName = $disciplineName;
        return $this;
    }

    public function setGradeValue(int $gradeValue): self
    {
        $this->gradeValue = $gradeValue;
        return $this;
    }

    public function setCredits(int $credits): self
    {
        $this->credits = $credits;
        return $this;
    }

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    
}