<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * @OA\Schema(
 *     schema="DisciplineType",
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

final class DisciplineType
{
    private int $id;
    private string $type;


    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function updateType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

}