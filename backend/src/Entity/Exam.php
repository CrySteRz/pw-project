<?php

declare(strict_types=1);

namespace App\Entity;

final class Exam
{
    private int $id;
    private int $idDiscipline;
    private date $examDate;


    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    
    public function getId(): int
    {
        return $this->id;
    }

    public function getIdDiscipline(): int
    {
        return $this->idDiscipline;
    }

    public function getExamDate(): DateTime
    {
        return $this->examDate;
    }

    public function updateIdDiscipline(int $idDiscipline): self
    {
        $this->idDiscipline = $idDiscipline;
        return $this;
    }

    public function updateExamDate(DateTime $examDate): self
    {
        $this->examDate = $examDate;
        return $this;
    }
}