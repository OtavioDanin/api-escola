<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class AlunoException extends Exception
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}
