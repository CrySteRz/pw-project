<?php

declare(strict_types=1);

namespace App\Exception;

final class NotFound extends Base
{
    public function __construct(string $message = 'Not Found', int $code = 404)
    {
        parent::__construct($message, $code);
    }

}