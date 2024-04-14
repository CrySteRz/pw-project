<?php

declare(strict_types=1);

namespace App\Entity;


/**
 * @OA\Schema(
 *     title="Discipline",
 *     description="Discipline entity",
 *     required={"id", "name", "credits"}
 * )
 */
final class Discipline
{
    /**
     * @OA\Property(
     *     format="int64",
     *     description="The unique identifier for the discipline",
     *     example=1
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     description="The name of the discipline"
     * )
     *
     * @var string
     */
    private string $name;
    
    /**
     * @OA\Property(
     *     description="The number of credits associated with the discipline",
     *     example=3
     * )
     *
     * @var int
     */
    private int $credits;
    
    /**
     * @OA\Property(
     *     format="int64",
     *     description="The unique identifier for the discipline (if different from 'id')",
     *     example=1001
     * )
     *
     * @var int
     */
    private int $idDiscipline;

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getCredits(): int
    {
        return $this->credits;
    }

    public function getIdDiscipline(): int
    {
        return $this->idDiscipline;
    }


    public function updateId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function updateName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function updateCredits(int $credits): self
    {
        $this->credits = $credits;
        return $this;
    }

    public function updateIdDiscipline(int $idDiscipline): self
    {
        $this->idDiscipline = $idDiscipline;
        return $this;
    }


}