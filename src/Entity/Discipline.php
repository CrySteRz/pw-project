<?php

declare(strict_types=1);

namespace App\Entity;

final class Task
{
    private int $id;
    private string $name;
    private string $category;
    private int $credits;
    private int $userDisciplinesId;
    private int $exanId;

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

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCredits(): int
    {
        return $this->credits;
    }

    public function getUserDisciplinesId(): int
    {
        return $this->userDisciplinesId;
    }

    public function getExamId(): int
    {
        return $this->examId;
    }

    public function updateName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function updateCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function updateCredits(int $credits): self
    {
        $this->credits = $credits;
        return $this;
    }

    public function updateUserDisciplinesId(int $userDisciplinesId): self
    {
        $this->userDisciplinesId = $userDisciplinesId;
        return $this;
    }

    public function updateExamId(int $examId): self
    {
        $this->examId = $examId;
        return $this;
    }
}