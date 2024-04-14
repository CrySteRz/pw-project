<?php

declare(strict_types=1);

namespace App\Repository;

abstract class BaseRepository
{
    public function __construct(protected \PDO $database)
    {
    }

    protected function getDb(): \PDO
    {
        return $this->database;
    }

}