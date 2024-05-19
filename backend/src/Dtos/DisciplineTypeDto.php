<?php

declare(strict_types=1);

namespace App\Dtos;

/**
 * @OA\Schema(
 *     schema="DisciplineTypeDTO",
 *     required={"id", "type"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="The unique identifier of the discipline type"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         description="The type of the discipline"
 *     )
 * )
 */

final class DisciplineTypeDto
{
    public int $id;
    public string $type;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }
}