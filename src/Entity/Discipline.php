<?php

declare(strict_types=1);

namespace App\Entity;

final class Discipline
{
    private int $id;
    private string $name;
    private int $credits;
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