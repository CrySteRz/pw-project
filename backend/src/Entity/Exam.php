<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * @OA\Schema(
 *     schema="Exam",
 *     required={"id", "idDiscipline", "examDate"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="The unique identifier of the exam"
 *     ),
 *     @OA\Property(
 *         property="idDiscipline",
 *         type="integer",
 *         format="int64",
 *         description="The unique identifier of the discipline"
 *     ),
 *     @OA\Property(
 *         property="examDate",
 *         type="string",
 *         format="date",
 *         description="The date of the exam"
 *     )
 * )
 */

final class Exam
{
    private int $id;
    private int $idDiscipline;
    private \DateTime $examDate;


    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getIdDiscipline(): int
    {
        return $this->idDiscipline;
    }

    public function getExamDate(): \DateTime
    {
        return $this->examDate;
    }

    public function updateIdDiscipline(int $idDiscipline): self
    {
        $this->idDiscipline = $idDiscipline;
        return $this;
    }

    public function updateExamDate(\DateTime $examDate): self
    {
        $this->examDate = $examDate;
        return $this;
    }
}