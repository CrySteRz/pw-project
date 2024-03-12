<?php

declare(strict_types=1);

namespace App\Entity;


/**
 * @OA\Schema(
 *     title="Grade",
 *     description="Grade entity",
 *     required={"id", "idExam", "idUser", "value"}
 * )
 */
final class Grade
{

    /**
     * @OA\Property(
     *     format="int64",
     *     description="The unique identifier for the grade",
     *     example=1
     * )
     *
     * @var int
     */
    private int $id;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="The unique identifier for the exam associated with the grade",
     *     example=1001
     * )
     *
     * @var int
     */
    private int $idExam;

     /**
     * @OA\Property(
     *     format="int64",
     *     description="The unique identifier for the user associated with the grade",
     *     example=2001
     * )
     *
     * @var int
     */
    private int $idUser;

    /**
     * @OA\Property(
     *     format="int64",
     *     description="The value of the grade",
     *     example=85
     * )
     *
     * @var int
     */
    private int $value;

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getIdExam(): int
    {
        return $this->idExam;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function updateId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    
    public function updateIdExam(int $idExam): self
    {
        $this->idExam = $idExam;
        return $this;
    }


    public function updateIdUser(int $idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }


    public function updateValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }

}