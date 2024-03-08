<?php

declare(strict_types=1);

namespace App\Entity;

final class Grade
{
    private int $id;
    private int $idExam;
    private int $idUser;
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