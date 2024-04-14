<?php

declare(strict_types=1);

namespace App\Dtos;

final class GradeDto
{
    public string $email;
    public string $examDate;
    public string $disciplineName;
    public int  $gradeValue;
    public int $credits;

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